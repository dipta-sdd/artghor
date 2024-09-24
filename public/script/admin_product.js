// load all categories
$.ajax({
    type: "get",
    url: "/api/category/index",
    success: function (cats) {
        $.each(cats, function (indexInArray, cat) {
            $("select.form-control[name=category_id]").append(`
            <option value="${cat.id}">${cat.name}</option>    
            `);
            $.each(cat.subcategories, function (indexInArray, sub) {
                $("select.form-control[name=subcategory_id]").append(`
                    <option class="d-none cat cat${cat.id}" value="${sub.id}">${sub.name}</option>    
                    `);
            });
        });
        getProduct();
    },
    error: (e) => {
        toastError();
    },
});
// get product details from server
function getProduct() {
    const url = window.location.href;
    let index = url.indexOf("=");
    const id = url.slice(index + 1, url.length);
    $.ajax({
        type: "get",
        url: "/api/product/read/" + id,
        success: function (product) {
            loadProduct(product);

            on_page_load("");
        },
    });
}
function loadProduct(prod) {
    $(".form-control[name=name]").val(prod.name);
    $(".form-control[name=description]").val(prod.description);
    $(".form-control[name=category_id]").val(prod.category_id);
    $(".form-control[name=subcategory_id]").val(prod.subcategory_id);
    $(".form-control[name=price]").val(prod.price);
    $(".form-control[name=quantity]").val(prod.quantity);
    $(".image1").attr("src", "/assets/uploades/" + prod.image1);
    if (prod.image2)
        $(".image2").attr("src", "/assets/uploades/" + prod.image2);
    if (prod.image3)
        $(".image3").attr("src", "/assets/uploades/" + prod.image3);
    if (prod.image4)
        $(".image4").attr("src", "/assets/uploades/" + prod.image4);
    $("#submit-button").attr("target", prod.id);

    $(".form-control").attr("disabled", "");
    $("#submit-button").attr("disabled", "");
    $("#main_con img ,  #edit").removeClass("d-none");
    $(".hidden").css("display", "none");
    if (prod.colorfamilies) {
        $(".color").remove();
        $.each(prod.colorfamilies, function (indexInArray, colorFamily) {
            $(".alert-con").after(`
                <div class="col-12 d-flex color" target="${colorFamily.id}">
                    <div class="flex-1 pe-2">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Color-Family <span class="text-danger">&nbsp; *</span> </span>
                            <input type="text" class="form-control" name="color_family" placeholder="Color Family" value="${colorFamily.color_family}" disabled>
                        </div>
                    </div>
                    <div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Quantity <span class="text-danger">&nbsp; *</span> </span>
                            <input type="number" class="form-control" name="color_quantity" placeholder="0"  value="${colorFamily.quantity}" disabled>
                        </div>
                    </div>
                    <div class="p-2 hidden">
                        <i class="fa-solid fa-trash" target="${colorFamily.id}"></i>
                    </div>
                </div>
            `);
        });
        $(".alert").addClass("d-none");
    }
}
$("#edit").click(function (e) {
    e.preventDefault();
    $(".form-control").removeAttr("disabled");
    $("#submit-button").removeAttr("disabled");
    $("#main_con img ,  #edit").addClass("d-none");
    $(".hidden").css("display", "block");
});
// click add color family
$("#btn_color_family").click(function (e) {
    e.preventDefault();
    $(".alert-con").after(`
        <div class="col-12 d-flex color">
            <div class="flex-1 pe-2">
                <div class="input-group mb-3">
                    <span class="input-group-text">Color-Family <span class="text-danger">&nbsp; *</span> </span>
                    <input type="text" class="form-control" name="color_family" placeholder="Color Family" >
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="input-group mb-3">
                    <span class="input-group-text">Quantity <span class="text-danger">&nbsp; *</span> </span>
                    <input type="number" class="form-control" name="color_quantity" placeholder="0" >
                </div>
            </div>
        </div>
    `);
    $(".hidden").css("display", "block");
});
//  load sub category on category change
$("select.form-control[name=category_id]").change(function (e) {
    e.preventDefault();
    $("select.form-control[name=subcategory_id] option.cat").addClass("d-none");
    $(`select.form-control option.cat${$(this).val()}`).removeClass("d-none");
});
const submitButton = $("#submit-button");
const imageInput1 = document.getElementById("image1");
const imageInput2 = document.getElementById("image2");
const imageInput3 = document.getElementById("image3");
const imageInput4 = document.getElementById("image4");
// const croppedImagePreview = document.getElementById("cropped-image-preview");
let croppedImageFile1;
let croppedImageFile2;
let croppedImageFile3;
let croppedImageFile4;
// let status1 = false;
// let status1 = false;
// let status1 = false;
// let status1 = false;

imageInput1.addEventListener("change", function (event) {
    const reader = new FileReader();
    reader.onload = function (event) {
        const img = new Image();
        img.onload = function () {
            let canvas = document.createElement("canvas");
            const ctx = canvas.getContext("2d");

            const squareSize = Math.min(img.width, img.height);
            const x = (img.width - squareSize) / 2;
            const y = (img.height - squareSize) / 2;

            canvas.width = squareSize;
            canvas.height = squareSize;

            ctx.drawImage(
                img,
                x,
                y,
                squareSize,
                squareSize,
                0,
                0,
                squareSize,
                squareSize
            );
            if (squareSize > 1000) {
                const newCanvas = document.createElement("canvas");
                newCanvas.width = 1000;
                newCanvas.height = 1000;
                const newCtx = newCanvas.getContext("2d");
                newCtx.drawImage(canvas, 0, 0, 1000, 1000);
                canvas = newCanvas;
            }
            croppedImageFile1 = dataURItoBlob(canvas.toDataURL("image/jpeg"));

            // croppedImagePreview.src = canvas.toDataURL();
        };
        img.src = event.target.result;
    };
    reader.readAsDataURL(event.target.files[0]);
});

imageInput2.addEventListener("change", function (event) {
    const reader = new FileReader();
    reader.onload = function (event) {
        const img = new Image();
        img.onload = function () {
            let canvas = document.createElement("canvas");
            const ctx = canvas.getContext("2d");

            const squareSize = Math.min(img.width, img.height);
            const x = (img.width - squareSize) / 2;
            const y = (img.height - squareSize) / 2;

            canvas.width = squareSize;
            canvas.height = squareSize;

            ctx.drawImage(
                img,
                x,
                y,
                squareSize,
                squareSize,
                0,
                0,
                squareSize,
                squareSize
            );
            if (squareSize > 1000) {
                const newCanvas = document.createElement("canvas");
                newCanvas.width = 1000;
                newCanvas.height = 1000;
                const newCtx = newCanvas.getContext("2d");
                newCtx.drawImage(canvas, 0, 0, 1000, 1000);
                canvas = newCanvas;
            }
            croppedImageFile2 = dataURItoBlob(canvas.toDataURL("image/jpeg"));

            // croppedImagePreview.src = canvas.toDataURL();
        };
        img.src = event.target.result;
    };
    reader.readAsDataURL(event.target.files[0]);
});

imageInput3.addEventListener("change", function (event) {
    const reader = new FileReader();
    reader.onload = function (event) {
        const img = new Image();
        img.onload = function () {
            let canvas = document.createElement("canvas");
            const ctx = canvas.getContext("2d");

            const squareSize = Math.min(img.width, img.height);
            const x = (img.width - squareSize) / 2;
            const y = (img.height - squareSize) / 2;

            canvas.width = squareSize;
            canvas.height = squareSize;

            ctx.drawImage(
                img,
                x,
                y,
                squareSize,
                squareSize,
                0,
                0,
                squareSize,
                squareSize
            );
            if (squareSize > 1000) {
                const newCanvas = document.createElement("canvas");
                newCanvas.width = 1000;
                newCanvas.height = 1000;
                const newCtx = newCanvas.getContext("2d");
                newCtx.drawImage(canvas, 0, 0, 1000, 1000);
                canvas = newCanvas;
            }
            croppedImageFile3 = dataURItoBlob(canvas.toDataURL("image/jpeg"));

            // croppedImagePreview.src = canvas.toDataURL();
        };
        img.src = event.target.result;
    };
    reader.readAsDataURL(event.target.files[0]);
});

imageInput4.addEventListener("change", function (event) {
    const reader = new FileReader();
    reader.onload = function (event) {
        const img = new Image();
        img.onload = function () {
            let canvas = document.createElement("canvas");
            const ctx = canvas.getContext("2d");

            const squareSize = Math.min(img.width, img.height);
            const x = (img.width - squareSize) / 2;
            const y = (img.height - squareSize) / 2;

            canvas.width = squareSize;
            canvas.height = squareSize;

            ctx.drawImage(
                img,
                x,
                y,
                squareSize,
                squareSize,
                0,
                0,
                squareSize,
                squareSize
            );
            if (squareSize > 1000) {
                const newCanvas = document.createElement("canvas");
                newCanvas.width = 1000;
                newCanvas.height = 1000;
                const newCtx = newCanvas.getContext("2d");
                newCtx.drawImage(canvas, 0, 0, 1000, 1000);
                canvas = newCanvas;
            }
            croppedImageFile4 = dataURItoBlob(canvas.toDataURL("image/jpeg"));

            // croppedImagePreview.src = canvas.toDataURL();
        };
        img.src = event.target.result;
    };
    reader.readAsDataURL(event.target.files[0]);
});

// AJAX upload logic
submitButton.on("click", function (event) {
    event.preventDefault();
    let target = $("#submit-button").attr("target");
    // Create a FormData object to collect form data
    const formData = new FormData();
    formData.append("name", $('input[name="name"]').val());
    formData.append("description", $('textarea[name="description"]').val());
    formData.append("category_id", $('select[name="category_id"]').val());
    formData.append("subcategory_id", $('select[name="subcategory_id"]').val());
    formData.append("price", $('input[name="price"]').val());
    formData.append("quantity", $('input[name="quantity"]').val());
    if (croppedImageFile1)
        formData.append("image1", croppedImageFile1, "hjjhhj.jpg");
    if (croppedImageFile2)
        formData.append("image2", croppedImageFile2, "hjjhhjg.jpg");
    if (croppedImageFile3)
        formData.append("image3", croppedImageFile3, "hjjhhjd.jpg");
    if (croppedImageFile4)
        formData.append("image4", croppedImageFile4, "hjjhhdj.jpg");
    let colorFamily = collectDataArr(".form-control[name=color_family]");
    let colorQuantity = collectDataArr(".form-control[name=color_quantity]");
    formData.append("color_family", JSON.stringify(collectColorData()));

    // Add additional image fields if necessary
    // ...

    // Send the form data via AJAX
    $.ajax({
        url: "/api/product/update/" + target, // Replace with your actual endpoint
        type: "POST",
        data: formData,
        headers: {
            Authorization: "Bearer " + getCookie("token"),
        },
        processData: false,
        contentType: false,
        success: function (response) {
            // Handle successful upload
            console.log("Upload successful:", response);
            loadProduct(response);
            showToast("Product successfully updated.", "primary", true);
        },
        error: function (e) {
            // Handle upload error
            console.error("Upload error:", error);
            showToast(e.message, "danger", true);
        },
    });
});

function dataURItoBlob(dataURI) {
    // Split the data URI into parts
    const parts = dataURI.split(",");
    const contentType = parts[0].replace(/^data:image\/(\w+);base64,/, "");
    const base64Data = parts[1];

    // Convert base64 data to a byte array
    const byteString = atob(base64Data);
    const byteArrays = [];
    for (let i = 0; i < byteString.length; i++) {
        byteArrays.push(byteString.charCodeAt(i));
    }

    const byteArray = new Uint8Array(byteArrays);

    // Create a Blob object
    return new Blob([byteArray], { type: contentType });
}
// function to collect color family
function collectColorData() {
    const colorData = [];
    $(".color").each(function () {
        const colorFamily = $(this).find('input[name="color_family"]').val();
        const colorQuantity = $(this)
            .find('input[name="color_quantity"]')
            .val();
        const target = $(this).attr("target");

        if (colorFamily && colorQuantity) {
            const colorObject = {
                color_family: colorFamily,
                quantity: parseInt(colorQuantity),
            };

            if (target) {
                colorObject.id = target;
            }

            colorData.push(colorObject);
        }
    });
    return colorData;
}

// delete color family
$(document).on("click", ".fa-trash", function (e) {
    e.preventDefault();
    let id = e.target.getAttribute("target");
    $.ajax({
        type: "delete",
        url: "/api/colorFamily/delete/" + id,
        headers: {
            Authorization: "Bearer " + getCookie("token"),
        },
        success: function (response) {
            $(`.color[target=${id}]`).remove();
            loadProduct(response);
        },
        error: function (e) {
            showToast(e.message, "danger", true);
        },
    });
});
