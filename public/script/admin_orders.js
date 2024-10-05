$(document).ready(function () {
    loadFromURL();
});
function loadFromURL() {
    const url = window.location.href;
    const urlParams = new URL(url).searchParams;
    const data = Object.fromEntries(urlParams);

    $.ajax({
        type: "get",
        url: "/api/order/admin/all",
        data: data,
        success: function (orders) {
            loadOrders(orders);
        },
        error: function (error) {
            toastError();
        },
    });
}

function loadOrders(orders) {
    $("tbody").html("");
    $.each(orders.data, function (indexInArray, order) {
        $("tbody").append(`
                <tr class="order" target=${order.id}>
                    <td>${order.id}</td>
                    <td>${order.name}</td>
                    <td>${order.area}</td>
                    <td>${new Date(order.created_at).toLocaleString()}</td>
                    <td>${
                        order.delevery_time
                            ? new Date(order.delevery_time).toLocaleDateString()
                            : ""
                    }</td>
                    <td>${
                        parseFloat(order.total) + parseFloat(order.delevery_fee)
                    }</td>
                    <td>${order.payment_type}</td>
                    <td>${
                        order.status
                    } ${order.payment_type == "Cash On Delevery" && order.status == "pending" ? `<button target="${order.id}"><i class="fa-solid fa-check"></i></button>` : ""}</td>
                </tr>    
            `);
    });
    if (orders.data.length == 0) {
        $("tbody").append(`
            <tr>
                <td colspan="8">No Orders</td>
            </tr>
        `);
    }
    $("ul.pagination").html("");
    $.each(orders.links, function (indexInArray, page) {
        // console.log(page);
        $(".pagination").append(`
            <li class="page-item ${
                page.url ? "" : "disabled"
            } ${page.active ? 'active" aria-current="page"' : '"'} target="${page.url}"><a class="page-link" href="#">${page.label}</a></li>    
        `);
    });
}

function setURL() {
    const sortBy = $("#sort").val();
    const limit = $("#limit").val();
    const status = $("#status").val();

    const url = new URL(window.location.href);
    const [sort, direction] = sortBy.split("-");
    url.searchParams.set("sort", sort);
    url.searchParams.set("direction", direction);
    url.searchParams.set("limit", limit);
    if (status) {
        url.searchParams.set("status", status);
    } else {
        url.searchParams.delete("status");
    }

    // Update the URL without reloading the page
    history.pushState(null, null, url.toString());
    loadFromURL();
}

// on filter change
$("#main_con .filter select").on("change", function () {
    setURL();
});

// on status button click
$(document).on("click", "tbody tr td button", function (e) {
    e.preventDefault();
    let target = $(this).attr("target");
    let parent = $(this).parent();
    $.ajax({
        type: "post",
        url: "/api/order/update/" + target,
        data: {
            status: "processing",
        },
        success: function (order) {
            $(parent).text(order.status);
        },
        error: function (error) {
            toastError();
        },
    });
});

$(document).on("click", "tbody tr:not(:has(button:hover))", function (e) {
    let id = $(this).attr("target");
    window.location.href = `/admin/order?id=${id}`;
});
