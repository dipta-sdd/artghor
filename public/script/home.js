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
    data: {
        page: 1,
        limit: 10,
    },
    success: function (prods) {
        if (prods.prev_page_url) {
            $("#prod_con .right .prev").attr("target", prods.prev_page_url);
            $("#prod_con .right .prev").removeClass("disabled");
        } else {
            $("#prod_con .right .prev").addClass("disabled");
        }
        if (prods.next_page_url) {
            $("#prod_con .right .next").attr("target", prods.next_page_url);
            $("#prod_con .right .next").removeClass("disabled");
        } else {
            $("#prod_con .right .next").addClass("disabled");
        }
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

$("#prod_con .right span").click(function (e) {
    e.preventDefault();
    if (!$(this).hasClass("disabled")) {
        $.ajax({
            type: "get",
            url: $(this).attr("target"),
            data: {
                limit: 10,
            },
            success: function (prods) {
                if (prods.prev_page_url) {
                    $("#prod_con .right .prev").attr(
                        "target",
                        prods.prev_page_url
                    );
                    $("#prod_con .right .prev").removeClass("disabled");
                } else {
                    $("#prod_con .right .prev").addClass("disabled");
                }
                if (prods.next_page_url) {
                    $("#prod_con .right .next").attr(
                        "target",
                        prods.next_page_url
                    );
                    $("#prod_con .right .next").removeClass("disabled");
                } else {
                    $("#prod_con .right .next").addClass("disabled");
                }
                $.map(prods.data, function (prod, indexOrKey) {
                    // console.log(prod);
                    $("#prod_con .d-flex .item:first-of-type").remove();
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
    }
});
