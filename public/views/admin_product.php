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
    <title>ArtGhor | Product</title>
    <style>
    .hidden {
        display: none;
    }

    .input-group-text {
        align-items: start;
    }

    #btn_color_family {
        float: right;
    }

    .fa-trash:hover {
        color: red;
        cursor: pointer;
    }
    </style>
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
                <h4>View Product</h4>
                <button class="btn btn-outline-primary header-btn" id="edit"><i class="fa-solid fa-pen"></i>
                    Edit
                </button>
                <hr>
            </div>
            <form class="row pt-2" id="main_con">
                <div class="input-group mb-3">
                    <span class="input-group-text">Name <span class="text-danger">&nbsp; *</span></span>
                    <input type="text" class="form-control main" name="name" placeholder="Product Name" disabled>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Description</span>
                    <textarea type="text" class="form-control main" name="description" placeholder="Description"
                        disabled></textarea>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Category <span class="text-danger">&nbsp; *</span> </span>
                        <select type="text" class="form-control main" name="category_id" disabled>
                            <option value="">Choose one...</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Sub <span class="text-danger">&nbsp; *</span>-Category </span>
                        <select type="text" class="form-control main" name="subcategory_id" disabled>
                            <option value="">Choose one...</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Price <span class="text-danger">&nbsp; *</span> </span>
                        <input type="number" class="form-control main" name="price" placeholder="0.0" disabled>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Quantity <span class="text-danger">&nbsp; *</span> </span>
                        <input type="number" class="form-control main" name="quantity" placeholder="0" disabled>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Image 1 <span class="text-danger">&nbsp; *</span> </span>
                        <input type="file" class="form-control main hidden" name="image1" id="image1" disabled>
                        <img src="" class="form-control main image1"></img>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Image 2</span>
                        <input type="file" class="form-control main hidden" name="image2" id="image2" disabled>
                        <img src="" class="form-control main image2"></img>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Image 3</span>
                        <input type="file" class="form-control main hidden" name="image3" id="image3" disabled>
                        <img src="" class="form-control main image3"></img>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Image 4</span>
                        <input type="file" class="form-control main hidden" name="image4" id="image4" disabled>
                        <img src="" class="form-control main image4"></img>
                    </div>
                </div>
                <div class="col-lg-12">
                    <img src="" alt="" srcset="" id="cropped-image-preview">
                </div>
                <hr>
                <div class="row hidden alert-con">
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert" style="display: inline-block; ">
                            No color family found.
                        </div>
                        <button class="btn btn-outline-primary mb-2" id="btn_color_family">Add color family</button>
                    </div>
                </div>



                <div><button class="btn btn-primary hidden" id="submit-button" disabled>Update</button></div>

            </form>
        </div>
    </div>






</body>
<script src="/script/jquery-3.7.1.min.js"></script>
<script src="/script/popper.min.js"></script>
<script src="/script/bootstrap.min.js"></script>
<script src="/script/script2.js"></script>
<script src="/script/admin.js"></script>
<script src="/script/admin_product.js"></script>
<script>
// on_page_load('');
</script>

</html>