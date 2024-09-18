// get product details from server

async function getProduct() {
    let user = null;
    const url = window.location.href;
    let index = url.indexOf("=");
    const id = url.slice(index + 1, url.length);
    await $.ajax({
        type: "get",
        url: "/api/product/read/" + id,
        success: async function (product) {
            $(".image-container").append(`
                <img src="/assets/uploades/${
                    product.image1
                }" class="active" alt="Product Image 1">
                <img src="/assets/uploades/${
                    product.image1
                }" class="act normal" alt="Product Image 1">
                ${
                    product.image2
                        ? `<img src="/assets/uploades/${product.image2}" class="normal" alt="Product Image 2">`
                        : ""
                }
                ${
                    product.image3
                        ? `<img src="/assets/uploades/${product.image3}" class="normal" alt="Product Image 3">`
                        : ""
                }
                ${
                    product.image4
                        ? `<img src="/assets/uploades/${product.image4}" class="normal" alt="Product Image 4">`
                        : ""
                }
            `);
            const imageContainer = document.querySelector(".image-container");
            const images = imageContainer.querySelectorAll("img:not(.active)");

            images.forEach((image) => {
                image.addEventListener("click", () => {
                    images.forEach((img) => img.classList.remove("act"));
                    image.classList.add("act");
                    const activeImage = imageContainer.querySelector(".active");
                    activeImage.src = image.src;
                });
            });

            $(".prod .data").append(`
                <span class="name">
                    ${product.name}
                </span>
                <table>
                    <tr>
                        <td>Price</td>
                        <td class="price">৳ ${product.price}</td>
                    </tr>
                    ${
                        product.colorfamilies.length
                            ? `
                    <tr>
                        <td>Color Family</td>
                        <td class="color-family">
                            <select class="form-control" name="colorfamily">
                            </select>
                        </td>
                    </tr>`
                            : ""
                    }
                    <tr>
                        <td>Quantity</td>
                        <td class="quantity">
                            <i class="fa-solid fa-minus"></i>
                            <span>1</span>
                            <i class="fa-solid fa-plus"></i>
                        </td>
                    </tr>
                </table>
                <div class="mt-5">
                    <button class="buy"><i class="fa-solid fa-bag-shopping"></i> By Now</button>
                    <button class="cart" target="${
                        product.id
                    }"><i class="fa-solid fa-cart-plus"></i> Add to Cart</button>
                </div>
                `);
            if (product.colorfamilies) {
                $.map(product.colorfamilies, function (cf, indexOrKey) {
                    $(".prod .data .color-family select").append(`
                    <option value="${cf.id}">${cf.color_family}</option>
                `);
                });
            }

            $("#breadcrumb").append(`
                <li><a href="/products?catgory=${product.category.id}"> <img src="/assets/uploades/${product.category.logo}"></img> ${product.category.name} </a></li>
                <li><a href="/products?catgory=${product.category.id}&subcatgory=${product.subcategory.id}"> <img src="/assets/uploades/${product.subcategory.logo}"></img> ${product.subcategory.name} </a></li>
            `);
            return await on_page_load("");
        },
    });
    return user;
}
$(document).ready(async function () {
    // console.log(new Date().getTime());
    await getProduct();
    // console.log(user);
    // console.log(new Date().getTime());
    const user = get_user();
    $(document).on("click", ".quantity .fa-plus", function (e) {
        let quantity = $(".quantity span").text();
        quantity++;
        $(".quantity span").text(quantity);
    });
    $(document).on("click", ".quantity .fa-minus", function (e) {
        let quantity = $(".quantity span").text();
        if (quantity > 0) {
            quantity--;
            $(".quantity span").text(quantity);
        }
    });

    $(document).on("click", ".cart", function (e) {
        e.preventDefault();
        if (user) {
            let product_id = e.target.getAttribute("target");
            let quantity = $(".quantity span").text();
            let datas = {};
            datas["quantity"] = quantity;
            let cf_id = $(".prod .data .color-family select").val();
            if (cf_id) {
                datas["colorfamilies_id"] = cf_id;
            }
            $.ajax({
                type: "post",
                url: "/api/cart/add/" + product_id,
                data: datas,
                headers: {
                    Authorization: "Bearer " + getCookie("token"),
                },
                success: function (res) {
                    $(".cart-global small").text(res.totalQuantity);
                },
                error: function (e) {
                    toastError();
                },
            });
        } else {
            location.replace("/login");
        }
    });
});
