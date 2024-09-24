// $("#main_con .btn").click(function (e) {
//     e.preventDefault();
//     var formData = new FormData($("#main_con")[0]);
//     $.ajax({
//         type: "post",
//         url: "/api/product/create",
//         data: formData,
//         processData: false,
//         contentType: false,
//         success: function (response) {
//             showToast("Product successfully added.", "primary", true);
//             // $("#main_con .form-control").val("");
//         },
//         error: (e) => {
//             e = e.responseJSON;
//             if (e.errors) labelErrors("#main_con .form-control", e.errors);
//             else toastError();
//         },
//     });
// });
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
        on_page_load("");
    },
    error: (e) => {
        toastError();
    },
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

    // Add additional image fields if necessary
    // ...

    // Send the form data via AJAX
    $.ajax({
        url: "/api/product/create", // Replace with your actual endpoint
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            showToast("Product successfully added.", "primary", true);
            $("#main_con .form-control").val("");
        },
        error: function (e) {
            // Handle upload error
            e = e.responseJSON;
            if (e.errors) labelErrors("#main_con .form-control", e.errors);
            else toastError();
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
