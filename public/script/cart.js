$.ajax({
    type: "get",
    url: "/api/cart/get",
    headers: {
        Authorization: "Bearer " + getCookie("token"),
    },
    success: function (cart) {
        $.map(cart.carts, function (prod, indexOrKey) {
            loadProd(prod);
        });
        upadteSummary();
        $(".spinner_con").css("display", "none");
    },
});

function loadProd(cart) {
    $(".carts-con").append(`
        <div class="mybg carts cart${cart.id}">
            <div class="form-check my-auto">
                <input class="form-check-input" type="checkbox" value="${
                    cart.id
                }"  checked/>
            </div>
            <img  src="/assets/uploades/${cart.product.image1}" alt="${
        cart.product.name
    } image">
            <div class="flex-1">
                <span class="name">${cart.product.name}</span>
                <div class="details row">
                    <div class="col-lg-3 col-6">
                        <span>${
                            cart.colorfamilies_id
                                ? cart.colorfamilies_id.color_family
                                : ""
                        }</span>
                    </div>
                    <div class="col-lg-3 col-6">
                        <span>Price :</span>
                        <span >৳ ${cart.product.price}</span>
                    </div>
                    <div class="quantity col-lg-3 col-6 quantity${cart.id}">
                        <i class="fa-solid fa-minus" target="${
                            cart.id
                        }" type="remove" price="${cart.product.price}"></i>
                        <span> ${cart.quantity} </span>
                        <i class="fa-solid fa-plus" target="${
                            cart.id
                        }" type="add" price="${cart.product.price}"></i>
                    </div>
                    <div class="col-lg-3 col-6" >
                        <span>Total :</span>
                        <span>৳<span class="total">${
                            cart.product.price * cart.quantity
                        }</span></span>
                    </div>
                </div>
            </div>
        </div>
    `);
}

$(document).on("click", ".quantity i", function (e) {
    upadteSummary();
    e = e.target;
    const target = e.getAttribute("target");
    const type = e.getAttribute("type");
    const price = e.getAttribute("price");

    let val = $(`.quantity${target} span`).text();
    if (type == "add") {
        val++;
    } else {
        val--;
    }
    $(`.quantity${target} span`).text(val);
    $(`.cart${target} .total`).text(val * price);
    if (val > 0) {
        $.ajax({
            type: "post",
            url: "/api/cart/update/" + target,
            data: {
                quantity: 1,
                type: type,
            },
            success: function (response) {},
            error: function (e) {
                toastError();
                val = $(`.quantity${target} span`).text();
                if (type == "add") val--;
                else val++;
                $(`.quantity${target} span`).text(val);
                $(`.cart${target} .total`).text(val * price);
            },
        });
    } else {
        $.ajax({
            type: "delete",
            url: "/api/cart/delete/" + target,
            success: function (response) {
                $(`.cart${target}`).remove();
            },
            error: function (e) {
                toastError();
                val = $(`.quantity${target} span`).text();
                if (type == "add") val--;
                else val++;
                $(`.quantity${target} span`).text(val);
                $(`.cart${target} .total`).text(val * price);
            },
        });
    }
});

$(document).on("click", ".carts .form-check-input", function (e) {
    upadteSummary();
});
$("#select_all").change(function (e) {
    e.preventDefault();
    let status = $("#select_all_text").text();
    if (status == "Select All") {
        $("#select_all_text").text("Deselect All");
        $(".carts .form-check-input").prop("checked", true);
    } else {
        $("#select_all_text").text("Select All");
        $(".carts .form-check-input").prop("checked", false);
    }
    upadteSummary();
});

$(".btn-checkout").click(function (e) {
    e.preventDefault();
    let data = [];
    const checkedCarts = $(".carts .form-check-input:checked");
    checkedCarts.each(function () {
        data.push($(this).val());
    });
    localStorage.setItem("checkout", JSON.stringify());
    $.ajax({
        type: "post",
        url: "/api/cart/checkout",
        headers: {
            Authorization: "Bearer " + getCookie("token"),
        },
        data: {
            total: $(".summary .sub-total").attr("amount"),
            dv_fee: $(".summary .dv-fee").attr("amount"),
            carts: data,
        },
        success: function (response) {
            localStorage.setItem("checkout", JSON.stringify(response));
            setTimeout(function () {
                location.replace("/checkout");
            }, 30);
        },
        error: function (e) {
            toastError();
        },
    });
});
function upadteSummary() {
    const allCarts = $(".carts .total");
    const checkedCarts = $(".carts:has(.form-check-input:checked) .total");
    if (allCarts.length == checkedCarts.length) {
        $("#select_all").prop("checked", true);
        $("#select_all_text").text("Deselect All");
    } else {
        $("#select_all").prop("checked", false);
        $("#select_all_text").text("Select All");
    }
    let total = 0;
    checkedCarts.each(function () {
        total += parseFloat($(this).text());
    });
    $(".sub-total").text("৳ " + total);
    $(".sub-total").attr("amount", total);
    total += parseFloat($(".summary .dv-fee").attr("amount"));
    $(".summary .total").text("৳ " + total);
}
