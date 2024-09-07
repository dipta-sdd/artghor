$.ajax({
    type: "get",
    url: "/api/product/index",
    data: {
        page: 1,
        limit: 5,
    },
    success: function (products) {
        loadProducts(products);
        on_page_load("admin");
    },
});

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
    $("ul.pagination").html("");
    $.each(products.links, function (indexInArray, page) {
        console.log(page);
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
