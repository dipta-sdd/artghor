$(document).ready(function () {
    loadFromURL();
});
function loadFromURL() {
    const url = window.location.href;
    const urlParams = new URL(url).searchParams;
    const data = Object.fromEntries(urlParams);

    $.ajax({
        type: "get",
        url: "/api/product/index",
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
    $("#prod_con .d-flex .item").remove();
    $.map(orders.data, function (prod, indexOrKey) {
        // console.log(prod);

        $("#prod_con .d-flex").append(`
                    <div class="item" target="${prod.id}">
                        <img src="/assets/uploades/${
                            prod.image1
                        }" alt="${prod.name}">
                        <span class="name">${prod.name}</span>
                        <span class="price">৳ ${parseFloat(prod.price).toFixed(
                            0
                        )}</span>
                    </div>
                    `);
    });

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
    const sortBy = $("#sortBy").val();
    const filter = $("#filterByForProductsPage").val();
    const limit = $("#limit").val();
    const val = $("#search").val();

    const url = new URL(window.location.href);
    url.searchParams.set("search", val);
    const [sort, direction] = sortBy.split("-");
    url.searchParams.set("sort", sort);
    url.searchParams.set("direction", direction);

    if (filter) {
        url.searchParams.set("category", filter);
    } else {
        url.searchParams.delete("category");
    }

    url.searchParams.set("limit", limit);
    // Update the URL without reloading the page
    history.pushState(null, null, url.toString());
    loadFromURL();
}

// on filter change
$(".filters select").on("change", function () {
    setURL();
});

// on enter event
$("#search").on("keyup", function (e) {
    e.preventDefault();
    if (e.keyCode === 13) {
        let val = $(this).val();
        setURL();
    }
});
$("#searchBtn").on("click", function (e) {
    e.preventDefault();

    let val = $("#search").val();
    setURL();
});

$(document).on("click", ".page-item:not(.disabled):not(.active)", function (e) {
    e.preventDefault();
    let link = $(this).attr("target");
    // alert(link);
    $.ajax({
        type: "get",
        url: link,
        data: {
            limit: $("#limit").val(),
        },
        success: function (orders) {
            loadOrders(orders);
        },
        error: function (error) {
            toastError();
        },
    });
});

$(document).on("click", "#prod_con .item", function (e) {
    let id = $(this).attr("target");
    location.replace("/product?id=" + id);
});
