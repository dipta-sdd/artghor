// console.log(getCookie("token"));
async function on_page_load(arg, loader) {
    let token = getCookie("token");
    if (token) {
        let user = get_user();
        if (user) {
            set_user(user, arg, loader);
        }
        return await verify_token(token, arg, loader);
    } else {
        $(".spinner_con").css("display", "none");
        return null;
    }
}
// get user from server
async function verify_token(token, arg, loader) {
    let u = null;
    await $.ajax({
        type: "POST",
        url: "/api/auth/me",
        headers: {
            Authorization: "Bearer " + token,
        },
        success: function (user) {
            createCookie("token", user.token, 3);
            set_user(user, arg, loader);
            u = user;
        },
        error: function (res) {
            deleteCookie("token");
            sessionStorage.removeItem("user");
            location.replace("/login");
        },
    });
    return u;
}

function set_user(user, arg, loader) {
    setTimeout(function () {
        sessionStorage.setItem("user", JSON.stringify(user));
    }, 30);

    if (!user.mobile_verified_at && !user.email_verified_at && arg != "otp") {
        location.replace("/otp");
    }
    if (arg == "!auth") {
        location.replace("/");
    }
    if (arg == "admin" && user.role != "admin") {
        location.replace("/login");
    } else if (arg == "user" && user.role != "user") {
        location.replace("/login");
    }
    $(".logged-out").addClass("d-none");
    $(".logged-in").removeClass("d-none");
    $(`.r-${user.role}`).removeClass("d-none");
    $("ul a.nav-link.user").html(
        `<i class="fa-solid fa-user"></i> ${user.name}`
    );
    if (user.cartQuantity) {
        $(".cart-global small").text(user.cartQuantity);
    }
    if (!loader) {
        $(".spinner_con").css("display", "none");
    }

    // $(".spinner_con")
    //     .delay(1000)
    //     .queue(function () {
    //         $(".spinner_con").css("display", "none");
    //         $(this).dequeue();
    //     });
}
function get_user() {
    let ret = JSON.parse(sessionStorage.getItem("user"));
    return ret;
}
// Function to create a cookie
function createCookie(name, value, days) {
    let expires = "";
    if (days) {
        let date = new Date();
        date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}

// Function to read a cookie
function getCookie(name) {
    let nameEQ = name + "=";
    let ca = document.cookie.split(";");
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === " ") c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0)
            return c.substring(nameEQ.length, c.length);
    }
    return null;
}

// Function to delete a cookie
function deleteCookie(name) {
    document.cookie = name + "=; Max-Age=-99999999;";
}
$(".logout").click(function (e) {
    e.preventDefault();
    // alert("logout");
    deleteCookie("token");
    sessionStorage.removeItem("user");

    location.replace("/login");
});

// toast
function toastError() {
    showToast("Something went wrong , try again.", "danger", true);
}
function showToast(msg, color, autohide) {
    $(".toast-container.position-static").append(`
    <div class="toast show text-bg-${color}" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true">
        <div class="toast-header">
            <img src="../images/favicon.svg" style="height: 20px; width:auto !important" class="rounded me-2" alt="...">
            <strong class="me-auto">Artghor</strong>
            <small class="text-body-secondary">${getCurrentTimeInCurrentTimezone()}</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            ${msg}
        </div>
    </div>
    `);
    if (autohide) {
        var newToast = $(".toast:last");
        setTimeout(function () {
            newToast.fadeOut(1000);
            newToast.remove();
        }, 5000);
    }
}
function getCurrentTimeInCurrentTimezone() {
    const now = new Date();
    const options = {
        timeZone: Intl.DateTimeFormat().resolvedOptions().timeZone,
        hour: "numeric",
        minute: "numeric",
    };
    const formatter = new Intl.DateTimeFormat("en-US", options);
    return formatter.format(now);
}

function collectDataArr(selector) {
    const data = [];
    let i = 0;
    $(selector).each(function () {
        data[i] = $(this).val();
        i++;
    });
    return data;
}
