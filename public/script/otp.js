$("#otp .input").keyup(function (e) {
    e.preventDefault();
    if (e.keyCode !== 8) {
        let index = $(this).index();
        if (index < $("#otp .input").length - 1) {
            $("#otp .input")
                .eq(index + 1)
                .focus();
        } else {
            checkOTP();
        }
    } else {
        let index = $(this).index();
        if (index > 0) {
            $("#otp .input")
                .eq(index - 1)
                .focus();
        }
    }
});

var timeElement = $("#otp span.time");
var timeElementA = $("#otp a");
var totalSecondsOTP = 300;
var totalSecondsA = 180;

var exp_countdown = setInterval(exp_count, 1000);
var res_countdown = setInterval(res_count, 1000);

function exp_count() {
    totalSecondsOTP--;

    var minutes = Math.floor(totalSecondsOTP / 60);
    var seconds = totalSecondsOTP % 60;

    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;
    timeElement.text(
        "Your OTP will be expired in " + minutes + "m " + seconds + "s."
    );

    if (totalSecondsOTP <= 0) {
        clearInterval(exp_countdown);
        timeElement.text("OTP expired");
    }
}
function res_count() {
    totalSecondsA--;

    var minutes = Math.floor(totalSecondsA / 60);
    var seconds = totalSecondsA % 60;

    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;
    timeElementA.text("Resend Code in " + minutes + "m " + seconds + "s.");

    if (totalSecondsA <= 0) {
        clearInterval(res_countdown);
        timeElementA.text("Resend Code");
        $(timeElementA).removeClass("disabled");
    }
}

$("#otp button.login").click(function (e) {
    e.preventDefault();
    checkOTP();
});
function checkOTP() {
    let inputs = $("#otp input.input");
    let data = "";
    data =
        $(inputs[0]).val() +
        $(inputs[1]).val() +
        $(inputs[2]).val() +
        $(inputs[3]).val() +
        $(inputs[4]).val() +
        $(inputs[5]).val();
    $.ajax({
        type: "POST",
        url: "/api/auth/verify",
        headers: {
            Authorization: "Bearer " + getCookie("token"),
        },
        data: {
            otp: data,
        },
        success: function (res) {
            console.log(res);
            location.replace("/");
        },
        error: function (res) {
            err = res.responseJSON;
            $("#otp span.error").text(err.message);
        },
    });
}

$.ajax({
    type: "POST",
    url: "/api/auth/otp",
    headers: {
        Authorization: "Bearer " + getCookie("token"),
    },
    success: function (response) {},
});
