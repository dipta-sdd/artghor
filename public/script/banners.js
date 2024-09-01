$.ajax({
    type: "GET",
    url: "/api/banner/index",
    success: function (banners) {
        console.log(banners);
        $.map(banners, function (banner, indexOrKey) {
            showBanner(banner);
        });
        $(".spinner_con").css("display", "none");
    },
});

function showBanner(banner) {
    $("#banners_con").append(`
        <div class="col-12" id="banner${banner.id}">
            <img src="../assets/uploades/${banner.path}" alt="">
            <div>
                <a href="${banner.link ? banner.link : "#"}"> ${
        banner.link ? banner.link : "No Link"
    } </a> <button class="delete" target="${
        banner.id
    }"><i class="fa-solid fa-trash"></i></button>
            </div>
        </div>    
    `);
}
// delete a banner
$(document).on("click", "#banners_con .col-12 div button.delete", function (e) {
    e.preventDefault();
    let target = $(this).attr("target");
    $.ajax({
        type: "DELETE",
        url: "/api/banner/delete/" + target,
        success: function (res) {
            $(`#banner${target}`).remove();
            showToast(res.message, "primary", true);
        },
        error: function (err) {
            toastError();
        },
    });
});
// add an banner
$("form.offcanvas-body ").submit(function (e) {
    e.preventDefault();
    let data = new FormData(this);
    console.log(data);
    $.ajax({
        type: "POST",
        url: "/api/banner/create",
        data: data,
        processData: false, // Don't process data with `processData`
        contentType: false,
        success: function (banner) {
            showBanner(banner);
            $("form.offcanvas-body .form-control-sm").val("");
        },
        error: function (error) {
            toastError();
        },
    });
});
