<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/x-icon" href="../images/favicon.svg">
    <link rel="stylesheet" href="/style/bootstrap.min.css" />
    <link rel="stylesheet" href="/style/style.css" />
    <link rel="stylesheet" href="/style/admin.css" />
    <link rel="stylesheet" href="/style/admin_categories.css" />
    <title>ArtGhor</title>
</head>

<body>
    <?php require_once 'navbar_admin.php' ?>
    <div class="body-con">
        <div class="sidebar con">
            <div class="con">
                <?php require_once 'sidebar.php' ?>
            </div>
        </div>
        <div class="admin-body">
            <div class="col-12" id="dashboard_header">
                <h4>Category</h4>
                <button class="btn btn-outline-primary header-btn" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fa-solid fa-plus"></i> Add
                    Catagory
                </button>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                    aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasRightLabel">Add New Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <form class="offcanvas-body">
                        <div class="mb-3">
                            <label class="col-form-label-sm">Category <span class="text-danger">*</span></label>
                            <input name="name" class="form-control form-control-sm" type="text" placeholder="Category">
                            <small class="text-danger"></small>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label-sm">Description</label>
                            <textarea name="description" class="form-control form-control-sm" type="text"
                                placeholder="Dscription"></textarea>
                            <small class="text-danger"></small>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label-sm">Icon <span class="text-danger">*</span></label>
                            <input name="logo" class="form-control form-control-sm" type="file">
                            <small class="text-danger"></small>
                        </div>

                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>
                </div>
                <hr>
            </div>
            <div class="row py-2 px-1" id="main_con">
            </div>
        </div>
    </div>




</body>
<script src="/script/jquery-3.7.1.min.js"></script>
<script src="/script/popper.min.js"></script>
<script src="/script/bootstrap.min.js"></script>
<script src="/script/script.js"></script>
<script src="/script/admin.js"></script>
<script>
$.ajax({
    type: "get",
    url: "/api/category/index",
    success: function(cats) {
        console.log(cats);
        $.each(cats, function(indexInArray, cat) {
            showCat(cat);
        });
        on_page_load('');
    },
    error: (e) => {
        toastError();
    }
});

function showCat(cat) {
    $('#main_con').append(`
            <div class="col-lg-3 col-md-4 p-1"> 
                <div class="cat">
                    <div class="cat-con">
                        <div class="cat-icon-name">
                            <img src="${"/assets/uploades/" +cat.logo}" alt="${cat.name} icon" srcset=""> 
                            <span>${cat.name}</span>
                            <i class="fa-solid fa-caret-down"></i> 
                        </div>
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <ul>
                        <li>hjhjhj</li>
                        <li>hjhjhj</li>
                        <li>hjhjhj</li>
                        <li>hjhjhj</li>
                        <li>hjhjhj</li>
                        <li>hjhjhj</li>
                        <li>hjhjhj</li>
                    </ul>
                </div>
            </div>
        `);
}

$('.offcanvas-body button.btn').click(function(e) {
    e.preventDefault();
    var formData = new FormData($('form.offcanvas-body')[0]);
    $.ajax({
        type: "post",
        url: "/api/category/create",
        data: formData,
        processData: false, //if file uploaded
        contentType: false,
        success: function(response) {
            showToast("Category Succefully Added.", 'primary', true);
            $('form.offcanvas-body .form-control').val('');
        },
        error: (e) => {
            e = e.responseJSON;
            if (!e) {
                toastError();
            }
            labelErrors('form.offcanvas-body .form-control', e.errors);
        }
    });
});
</script>

</html>