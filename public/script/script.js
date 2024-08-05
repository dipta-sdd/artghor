// console.log(getCookie("token"));
function on_page_load(arg) {
    let token = getCookie("token");
    if (token) {
        $.ajax({
            type: "POST",
            url: "/api/auth/me",
            headers: {
                Authorization: "Bearer " + token,
            },
            success: function (user) {
                setTimeout(function () {
                    localStorage.setItem("user", JSON.stringify(user));
                }, 30);

                if (
                    !user.mobile_verified_at &&
                    !user.email_verified_at &&
                    arg != "otp"
                ) {
                    location.replace("/otp");
                }
                if (arg == "!auth") {
                    location.replace("/");
                }
                $(".logged-out").addClass("d-none");
                $(".logged-in").removeClass("d-none");
                $("ul a.nav-link.user").html(
                    `<i class="fa-solid fa-user"></i> ${user.name}`
                );
                $(".spinner_con").css("display", "none");
                // $(".spinner_con")
                //     .delay(1000)
                //     .queue(function () {
                //         $(".spinner_con").css("display", "none");
                //         $(this).dequeue();
                //     });
            },
            error: function (res) {
                $(".spinner_con").css("display", "none");
            },
        });
    } else {
        $(".spinner_con").css("display", "none");
    }
}
function get_user() {
    let ret = JSON.parse(localStorage.getItem("user"));
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
    localStorage.removeItem("user");

    location.replace("/login");
});
