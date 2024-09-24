const url = window.location.href;
let index = url.indexOf("=");
const id = url.slice(index + 1, url.length);
if (!id) {
    window.location.href = "/404.html";
}
$.ajax({
    type: "get",
    url: "/api/order/get/" + id,
    headers: {
        Authorization: "Bearer " + getCookie("token"),
    },
    success: function (order) {
        console.log(order);
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
                        }:   ${new Date(
            order.delevery_time
        ).toLocaleDateString()}</span>
                    </div>
                    <hr>
                    <div class="row" style="margin-inline:-8px" id="order${
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
        on_page_load("user");
    },
    error: function (e) {
        window.location.href = "/404.html";
    },
});

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
