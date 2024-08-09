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
            console.log(res.user.role);
            if (res.user.role == "admin") location.replace("/dashboard");
            else location.replace("/");
        },
        error: function () {
            showToast("Invalid credentials. Try again", "danger", false);
        },
    });
});
