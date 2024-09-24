// $(".login.next").click(function (e) {
//     e.preventDefault();
//     let target = $(this).attr("target");
//     if (target == 1) {
//         if ($(".p1.email").val() == $(".p1.mobile").val()) {
//             $(".p1.input").addClass("is-invalid");
//             $("span.error").text("Please enter a valid email or phone.");
//         } else {
//             $(".p1.input").removeClass("is-invalid");
//             $("span.error").text("");
//             let email = $(".p1.email").val();
//             if (email != "") {
//                 if (isValidEmail(email)) {
//                     $(".p1, .p2").toggleClass("d-none");
//                 } else {
//                     $(".p1.email").addClass("is-invalid");
//                     $("span.error").text("Please enter a valid email.");
//                 }
//             } else {
//                 $(".p1, .p2").toggleClass("d-none");
//             }
//         }
//     } else {
//         $(".p3, .p2").toggleClass("d-none");
//     }
// });

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

$("button.login").click(function (e) {
    e.preventDefault();
    let data = collectData("#signup .input");
    $.ajax({
        type: "POST",
        url: "/api/auth/register",
        data: data,
        success: function (res) {
            createCookie("token", res.access_token, 3);
            location.replace("/otp");
        },
        error: function (res) {
            let error = res.responseJSON;
            $(".input").removeClass("is-invalid");
            $(".error").text(error.message.split(".")[0]);
            $.map(error.errors, function (val, index) {
                console.log(index);
                $(`.input[name="${index}"]`).addClass("is-invalid");
            });
            if (error.errors.password) {
                $(`.input[name="password_confirmation"]`).addClass(
                    "is-invalid"
                );
            }
        },
    });
});
function collectData(selector) {
    const data = {};
    $(selector).each(function () {
        data[$(this).attr("name")] = $(this).val();
    });

    return data;
}
