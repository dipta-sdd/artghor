let user = get_user();
if (!user) {
    window.location.href = "/home";
} else {
    $("#personal-details .form-control").each(function () {
        $(this).val(user[$(this).attr("name")]);
    });
    $.ajax({
        type: "get",
        url: "/api/user/location",
        success: function (address) {
            if (address.name) {
                $("#address .form-control").each(function () {
                    $(this).val(address[$(this).attr("name")]);
                });
                $("#address button").html(
                    ' <i class="fa-solid fa-save " aria-hidden="true"></i>  Update'
                );
            }
        },
    });
}

$("#personal-details button.edit").click(function (e) {
    e.preventDefault();
    $(this).addClass("d-none");
    $("#personal-details button.save").removeClass("d-none");
    $("#personal-details .form-control").removeAttr("disabled");
});

$("#personal-details button.save").click(function (e) {
    e.preventDefault();
    let data = collectData("#personal-details .form-control");
    // remove nulls from data
    Object.keys(data).forEach(function (key) {
        if (data[key] == null) {
            delete data[key];
        }
    });
    $.ajax({
        type: "post",
        url: "/api/user/update",
        data: data,
        success: function (user) {
            showToast("Details Successfully Updated", "primary", true);
            $("#personal-details .form-control").each(function () {
                $(this).val(user[$(this).attr("name")]);
            });
            $("#personal .form").each(function () {
                $(this).val("disabled", true);
            });
            $("#personal-details button").toggleClass("d-none");
        },
        error: function (error) {
            showToast(error.responseJSON.message, "danger", true);
        },
    });
});

$("#security button").click(function (e) {
    e.preventDefault();
    let data = collectData("#security .form-control");
    $.ajax({
        type: "post",
        url: "/api/user/updatePassword",
        data: data,
        success: function (res) {
            showToast("Password Successfully Updated", "primary", true);
            $("#security .form-control").val(value);
        },
        error: function (e) {
            e = e.responseJSON;
            if (e.errors) {
                labelErrors("#security .form-control", e.errors);
            } else {
                showToast(e.message, "danger", true);
            }
        },
    });
});

$("#address button").click(function (e) {
    e.preventDefault();
    let data = collectData("#address .form-control");
    $.ajax({
        type: "post",
        url: "/api/user/location",
        data: data,
        success: function (res) {
            showToast("Location Successfully Updated", "primary", true);
            $("#address button").html(
                ' <i class="fa-solid fa-save " aria-hidden="true"></i>  Update'
            );
        },
        error: function (e) {
            e = e.responseJSON;
            if (e.errors) {
                labelErrors("#address .form-control", e.errors);
            } else {
                showToast(e.message, "danger", true);
            }
        },
    });
});
