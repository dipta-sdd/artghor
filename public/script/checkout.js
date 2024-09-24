let checkout = JSON.parse(localStorage.getItem("checkout"));

if (checkout) {
    $(".summary .sub-total").text("৳ " + checkout.order.total);
    $(".summary .dv-fee").text("৳ " + checkout.order.delevery_fee);
    $(".summary .total").text(
        "৳ " +
            (parseFloat(checkout.order.delevery_fee) +
                parseFloat(checkout.order.total))
    );
    on_page_load("user");
} else {
    location.replace("/");
}

const bsCollapse = new bootstrap.Collapse("#collapse", {
    toggle: true,
});
$(".form-check-input").change(function (e) {
    e.preventDefault();
    let val = $(this).val();
    bsCollapse.toggle();
});

$(".btn-confirm").click(function (e) {
    e.preventDefault();
    let data = collectData(
        ".form .form-control , .form input.form-check-input:checked"
    );
    $.ajax({
        type: "post",
        url: "/api/cart/confirm/" + checkout.order.id,
        data: data,
        headers: {
            Authorization: "Bearer " + getCookie("token"),
        },
        success: function (response) {
            localStorage.removeItem("checkout");
            location.replace("/profile/order?id=" + checkout.order.id);
        },
        error: function (e) {
            e = e.responseJSON;
            if (e.errors) {
                labelErrors(".form .form-control", e.errors);
            } else {
                toastError();
            }
        },
    });
});
