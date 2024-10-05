// fetch category from server

loadCategory();
function loadCategory() {
    $.ajax({
        type: "get",
        url: "/api/category/index",
        success: function (categories) {
            loadCategories(categories);
            loadFromURL();
            on_page_load("admin");
        },
        error: function (error) {
            on_page_load("admin");
            toastError();
        },
    });
}

function loadCategories(categories) {
    $.each(categories, function (indexInArray, category) {
        $("#category").append(`
                <option value="${category.id}">${category.name}</option>
            `);
    });
}
function loadFromURL() {
    const url = window.location.href;
    const urlParams = new URL(url).searchParams;
    const data = Object.fromEntries(urlParams);

    $.ajax({
        type: "get",
        url: "/api/product/index",
        data: data,
        success: function (products) {
            loadProducts(products);
        },
        error: function (error) {
            toastError();
        },
    });
}

function getdata(link) {
    $.ajax({
        type: "get",
        url: link,
        data: {
            limit: 5,
        },
        success: function (products) {
            loadProducts(products);
        },
        error: function (error) {
            toastError();
        },
    });
}

// load to table
function loadProducts(products) {
    $("tbody").html("");
    $.each(products.data, function (indexInArray, product) {
        $("tbody").append(`
                <tr class="product" target=${product.id}>
                    <td class="img" scope="row"><img src="/assets/uploades/${product.image1}" alt="" srcset=""></td>
                    <td>${product.name}</td>
                    <td>${product.category.name}</td>
                    <td>${product.subcategory.name}</td>
                    <td>${product.price}</td>
                    <td>${product.quantity}</td>
                </tr>    
            `);
    });
    if (products.data.length == 0) {
        $("tbody").append(`
            <tr>
                <td colspan="6">No Products</td>
            </tr>
        `);
    }

    $("ul.pagination").html("");
    $.each(products.links, function (indexInArray, page) {
        // console.log(page);
        $(".pagination").append(`
            <li class="page-item ${
                page.url ? "" : "disabled"
            } ${page.active ? 'active" aria-current="page"' : '"'} target="${page.url}"><a class="page-link" href="#">${page.label}</a></li>    
        `);
    });
}

$(document).on("click", ".page-item:not(.disabled):not(.active)", function (e) {
    e.preventDefault();
    let link = $(this).attr("target");
    // alert(link);
    getdata(link);
});

function setURL() {
    const sortBy = $("#sort").val();
    const category = $("#category").val();
    const limit = $("#limit").val();
    const search = $("#search").val();

    const url = new URL(window.location.href);
    const [sort, direction] = sortBy.split("-");
    url.searchParams.set("sort", sort);
    url.searchParams.set("limit", limit);
    url.searchParams.set("direction", direction);
    if (search) {
        url.searchParams.set("search", search);
    } else {
        url.searchParams.delete("search");
    }
    if (category) {
        url.searchParams.set("category", category);
    } else {
        url.searchParams.delete("category");
    }

    // Update the URL without reloading the page
    history.pushState(null, null, url.toString());
    loadFromURL();
}
$(document).on("click", ".product", function (e) {
    e.preventDefault();
    let link = $(this).attr("target");
    location.replace("./product?id=" + link);
});

// when filter change
$(".filter select").on("change", setURL());

var input = document.getElementById("search");

$.ajax({
    type: "get",
    url: "/api/product/names",
    success: function (response) {
        autocomplete(input, response);
    },
});
