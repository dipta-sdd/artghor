// load categories
$.ajax({
    type: "get",
    url: "/api/category/index",
    success: function (cats) {
        $.map(cats, function (cat, indexOrKey) {
            $("#cat_con .d-flex").append(`
                    <div class="item">
                        <img src="/assets/uploades/${cat.logo}" alt="${cat.name}">
                        ${cat.name}
                    </div>
                    `);
        });
    },
});

// load products
$.ajax({
    type: "get",
    url: "/api/product/index",
    success: function (prods) {
        $.map(prods.data, function (prod, indexOrKey) {
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
    },
});

$(document).on("click", "#prod_con .item", function (e) {
    let id = $(this).attr("target");
    location.replace("/product?id=" + id);
});
