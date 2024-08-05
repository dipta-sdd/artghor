$("button.login").click(function (e) {
    e.preventDefault();
    let email = $(".input.email").val();
    $.ajax({
        type: "POST",
        url: "/api/auth/login",
        data: {
            email: email,
            username: email,
            mobile: email,
            password: $(".input.pass").val(),
        },
        success: function (res) {
            createCookie("token", res.access_token, 3);
            location.replace("/");
        },
    });
});
