loadOrders();
function loadOrders() {
    const url = window.location.href;
    const urlParams = new URL(url).searchParams;
    const data = Object.fromEntries(urlParams);
    if (data.filter) {
        JSON.stringify(data.filter);
    }
    // console.log(JSON.stringify(["pending", "processing"]));
    $.ajax({
        type: "get",
        url: "/api/order/get",
        data: data,
        headers: {
            Authorization: "Bearer " + getCookie("token"),
        },
        success: function (orders) {
            // console.log(order);
            $(".orders-con div.orders").remove();
            $.map(orders, function (order, indexOrKey) {
                $(".orders-con").append(`
                <div class="orders mybg">
                    <div class="d-flex header">
                        <span class="flex-1">
                            Order No :  ${order.id}
                        </span>
                        <span class="status" ${
                            order.status == "delivered" ? 'style="#00ff00"' : ""
                        }> ${order.status}</span>
                    </div>
                    <div class="header2">
                        <span>Created At :  ${new Date(
                            order.created_at
                        ).toLocaleDateString()}</span>
                        <span>${
                            order.status == "delivered"
                                ? "Delivered At"
                                : "Estimated Delivery "
                        }:   ${new Date(order.delevery_time).toLocaleDateString()}</span>
                    </div>
                    <hr>
                    <div class="row" style="margin-inline : -8px" id="order${
                        order.id
                    }"></div>
                    <hr>
                    <div class="row my-2">
                        <div class="address col-lg-6">
                            Delivery Address :
                        </div>
                        <div class="summary col-lg-6 ">
                            <h6>Order Summary</h6>
                            <div class="sum-row">
                                <span>Subtotal</span>
                                <span>৳ ${order.total}</span>
                            </div>
                            <div class="sum-row">
                                <span>Tax</span>
                                <span>৳ 0</span>
                            </div>
                            <div class="sum-row">
                                <span>Delivery Fee</span>
                                <span>৳ ${order.delevery_fee}</span>
                            </div>
                            <hr>
                            <div class="sum-row">
                                <span>Total</span>
                                <span>৳ ${
                                    parseFloat(order.total) +
                                    parseFloat(order.delevery_fee)
                                }</span>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
        `);

                $.map(order.items, function (item, indexOrKey) {
                    loadProd(`#order${order.id}`, item);
                });
            });

            if (orders.length == 0) {
                $(".orders-con").append(`
                    <div class="orders mybg">
                        <div class="d-flex header">
                            <span class="flex-1">
                                No Orders Found
                            </span>
                        </div>
                    </div>
                `);
            }
            on_page_load("user");
        },
        error: function (e) {
            // window.location.href = "/profile";
        },
    });
}

function loadProd(selector, item) {
    $(selector).append(`
        <div class="mybg order col-lg-6 mx-0">
            <img src="/assets/uploades/${item.product.image1}" alt="${
        item.product.name
    }">
            <div class="flex-1">
                <span class="name" target="${item.product.id}">${
        item.product.name
    }</span>
                <div class="details">
                    <div>
                        ${
                            item.product.colorfamily
                                ? `<span>CF :</span> ${item.product.colorfamily}`
                                : ""
                        }
                    </div>
                    <div>
                        <span>Price :</span> ৳ ${item.price}
                    </div>
                    <div>
                        <span>Qty:</span>&nbsp;${item.quantity}
                    </div>
                </div>
            </div>
        </div>
    `);
}

$(document).on("click", ".order .name", function () {
    let target = $(this).attr("target");
    window.location.href = `/product?id=${target}`;
});

$("#sortBy, .form-check-input").on("change", function () {
    const sortBy = $("#sortBy").val();
    const checkedFilters = $(".form-check-input:checked")
        .map(function () {
            return $(this).val();
        })
        .get();

    const url = new URL(window.location.href);
    url.searchParams.set("sort", sortBy);
    if (checkedFilters.length === 0) {
        url.searchParams.delete("filter");
    } else {
        url.searchParams.set("filter", JSON.stringify(checkedFilters));
    }

    // Update the URL without reloading the page
    history.pushState(null, null, url.toString());
    loadOrders();
});
