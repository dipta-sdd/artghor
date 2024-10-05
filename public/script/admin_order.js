let user = null;
const url = window.location.href;
let index = url.indexOf("=");
const id = url.slice(index + 1, url.length);
$.ajax({
    type: "get",
    url: "/api/order/admin/get/" + id,
    success: function (order) {
        $(`#main_con .header tbody`).append(`
            <tr>
                <td>Order No</td>
                <td>:</td>
                <td>${order.id}</td>
            </tr>
            <tr>
                <td>Customer Id</td>
                <td>:</td>
                <td>${order.user_id}</td>
            </tr>
            <tr>
                <td>Customer Name</td>
                <td>:</td>
                <td style="text-transform:capitalize">${order.name}</td>
            </tr>
            <tr>
                <td>Mobile</td> 
                <td>:</td>
                <td>
                    ${order.mobile}</td>
            </tr>
            <tr>
                <td>
                Created At
                </td>
                <td> :</td>
                <td> ${new Date(order.created_at).toLocaleDateString()} </td>
            </tr>
            <tr>
                <td>
                Last Update
                </td>
                <td> :</td>
                <td> ${new Date(order.updated_at).toLocaleDateString()} </td>
            </tr>
            <tr>
                <td>
                Address
                </td>
                <td> :</td>
                <td style="text-transform:capitalize"> ${
                    order.address +
                    ", " +
                    order.area +
                    ", " +
                    order.thana +
                    ", " +
                    order.district +
                    ", Bangladesh"
                } </td>
            </tr>
            <tr>
                <td>
                Total Amount
                </td>
                <td> :</td>
                <td> ${order.total} </td>
            </tr>
            <tr>
                <td>
                Delivery Fee
                </td>
                <td> :</td>
                <td> ${order.delevery_fee} </td>
            </tr>
            <tr>
                <td>
                Total
                </td>
                <td> :</td>
                <td> ${(
                    parseFloat(order.total) + parseFloat(order.delevery_fee)
                ).toFixed(2)} </td>
            </tr>
            <tr>
                <td>
                Payment Type
                </td>
                <td> :</td>
                <td class="payment_type" style="color: ${
                    order.payment_type == "Cash On Delevery"
                        ? "green"
                        : `${order.status == "pending" ? "red" : "Green"}`
                }"> ${order.payment_type} </td>
            </tr>
            ${
                order.payment_type != "Cash On Delevery"
                    ? `<tr>
                <td>
                Bkash No
                </td>
                <td> :</td>
                <td class="bkash_no"> ${order.bkash_no} </td>    
            </tr>
            <tr>
                <td>
                Transaction Id
                </td>
                <td> :</td>
                <td class="transaction_id"> ${
                    order.transaction_id ? order.transaction_id : ""
                } </td>
            </tr>`
                    : ``
            }
            <tr>
                <td>
                Status
                </td>
                <td> :</td>
                <td class="status" payment_type="${order.payment_type}"><span>${
            order.status
        }</span> <button class="edit"> <i class="fa-solid fa-pen-to-square"></i></button>
                
                <select class="form-control d-none">
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="shipped">Shipped</option>
                    <option value="delivered">Delivered</option>
                    <option value="cancelled">Cancelled</option>
                </select>
                <button class="save d-none" target="${
                    order.id
                }"> <i class="fa-solid fa-check"></i></button>
                <button class="cancel d-none"> <i class="fa-solid fa-xmark"></i></button>
                </td>
            </tr>
            <tr>
                <td>
                Delivery Date
                </td>
                <td> :</td>
                <td class="dv_date"> 
                <input class="form-control me-5" type="date" style="display: inline-block; width: max-content" value="${
                    order.delevery_time
                }" disabled>
                 <button class="edit"> <i class="fa-solid fa-pen-to-square"></i></button>
                 <button class="save d-none" target="${
                     order.id
                 }"> <i class="fa-solid fa-check"></i></button>
                <button class="cancel d-none"> <i class="fa-solid fa-xmark"></i></button>
                </td>
            </tr>
            
        `);
        $(".status select").val(order.status);
        let count = 0;
        $.map(order.items, function (item, indexOrKey) {
            count++;
            loadProduct(item, count);
        });
    },
});

function loadProduct(item, count) {
    $(`#main_con .items tbody`).append(`
        <tr>
            <th scope="row">${count}</th>
            <td class="img" scope="row">
                <img src="/assets/uploades/${item.product.image1}" alt="${item.product.name}">
            </td>
            <td class="product_name">
                ${item.product.name}
            </td>
            <td>${item.product.category.name}</td>
            <td>${item.product.subcategory.name}</td>
            <td>
                ৳ ${item.price}
            </td>
            <td>
                ${item.quantity}
            </td>
        </tr>
    `);
}

$(document).on("click", ".status button.edit", function () {
    $(".status span").addClass("d-none");
    $(".status button.edit").addClass("d-none");
    $(".status select").removeClass("d-none");
    $(".status button.save").removeClass("d-none");
    $(".status button.cancel").removeClass("d-none");
});

$(document).on("click", ".status button.save", function () {
    let val = $(".status select").val();
    let status = $(".status span").text();
    let payment_type = $(".payment_type").text();
    let target = $(this).attr("target");
    let payemnt_confim = false;
    if (
        status.toLowerCase() == "pending" &&
        payment_type.toLowerCase() != "cash on delevery"
    ) {
        payemnt_confim = confirm(
            `Are you sure you received payment through ${payment_type}?`
        );
    } else {
        payemnt_confim = true;
    }
    if (payemnt_confim) {
        $.ajax({
            type: "post",
            url: "/api/order/admin/update/" + target,
            data: {
                status: val,
            },
            success: function (order) {
                showToast("Status updated successfully.", "primary", true);
                $(".status span").text(order.status);
                $(".status span").removeClass("d-none");
                $(".status button.edit").removeClass("d-none");
                $(".status select").addClass("d-none");
                $(".status button.save").addClass("d-none");
                $(".status button.cancel").addClass("d-none");
            },
            error: (e) => {
                toastError();
            },
        });
    }
});

$(document).on("click", ".status button.cancel", function () {
    $(".status span").removeClass("d-none");
    $(".status button.edit").removeClass("d-none");
    $(".status select").addClass("d-none");
    $(".status button.save").addClass("d-none");
    $(".status button.cancel").addClass("d-none");
});

$(document).on("click", ".dv_date button.edit", function () {
    $(".dv_date input").removeAttr("disabled");
    $(".dv_date button.edit").addClass("d-none");
    $(".dv_date button.save").removeClass("d-none");
    $(".dv_date button.cancel").removeClass("d-none");
});

$(document).on("click", ".dv_date button.save", function () {
    let target = $(this).attr("target");
    let date = $(".dv_date input").val();
    $.ajax({
        type: "post",
        url: "/api/order/admin/update/" + target,
        data: {
            delevery_time: date,
        },
        success: function (order) {
            showToast("Delivery Date updated successfully.", "primary", true);
            $(".dv_date input").attr("disabled", true);
            $(".dv_date button.edit").removeClass("d-none");
            $(".dv_date button.save").addClass("d-none");
            $(".dv_date button.cancel").addClass("d-none");
        },
        error: (e) => {
            toastError();
        },
    });
});

$(document).on("click", ".dv_date button.cancel", function () {
    $(".dv_date input").attr("disabled", true);
    $(".dv_date button.edit").removeClass("d-none");
    $(".dv_date button.save").addClass("d-none");
    $(".dv_date button.cancel").addClass("d-none");
});
