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
                <h4>Add Product</h4>

                <hr>
            </div>
            <form class="row pt-2" id="main_con">
                <div class="input-group mb-3">
                    <span class="input-group-text">Name <span class="text-danger">&nbsp; *</span></span>
                    <input type="text" class="form-control" name="name" placeholder="Product Name">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Description</span>
                    <textarea type="text" class="form-control" name="description" placeholder="Description"></textarea>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Category <span class="text-danger">&nbsp; *</span> </span>
                        <select type="text" class="form-control" name="category_id">
                            <option value="0">0</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Sub <span class="text-danger">&nbsp; *</span>-Category </span>
                        <select type="text" class="form-control" name="subcategory_id">
                            <option value="0">0</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Price <span class="text-danger">&nbsp; *</span> </span>
                        <input type="number" class="form-control" name="price" placeholder="0.0">
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Quantity <span class="text-danger">&nbsp; *</span> </span>
                        <input type="number" class="form-control" name="quantity" placeholder="0">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Image 1 <span class="text-danger">&nbsp; *</span> </span>
                        <input type="file" class="form-control" name="image1">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Image 2</span>
                        <input type="file" class="form-control" name="image2">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Image 3</span>
                        <input type="file" class="form-control" name="image3">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Image 4</span>
                        <input type="file" class="form-control" name="image4">
                    </div>
                </div>
                <div><button class="btn btn-primary">Add</button></div>
            </form>
        </div>
    </div>






</body>
<script src="/script/jquery-3.7.1.min.js"></script>
<script src="/script/popper.min.js"></script>
<script src="/script/bootstrap.min.js"></script>
<script src="/script/script.js"></script>
<script src="/script/admin.js"></script>
<script>
on_page_load('');
$('#main_con .btn').click(function(e) {
    e.preventDefault();
    var formData = new FormData($('#main_con')[0]);
    $.ajax({
        type: "post",
        url: "/api/product/create",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {

        },
        error: (e) => {
            e = e.responseJSON;
            labelErrors('#main_con .form-control', e.errors);
        }
    });
});
</script>

</html>