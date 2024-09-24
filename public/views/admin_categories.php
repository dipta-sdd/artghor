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
    <!-- Modal for delete confirmation-->
    <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Are you sure?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    All product under this will be deleted permanently ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal  -->
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
                        <h5 class="offcanvas-title">Add New Category</h5>
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
                            <label class="col-form-label-sm">Icon <span class="text-danger req-icon">*</span></label>
                            <input name="logo" class="form-control form-control-sm" type="file">
                            <small class="text-danger"></small>
                        </div>

                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>
                </div>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEdit"
                    aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title">Edit Category</h5>
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
                            <label class="col-form-label-sm">Icon </label>
                            <input name="logo" class="form-control form-control-sm" type="file">
                            <small class="text-danger"></small>
                        </div>

                        <button class="btn btn-primary" type="submit">Update</button>
                    </form>
                </div>


                <div class="offcanvas offcanvas-end" tabindex="-1" id="offCanAddSub"
                    aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title">Add Sub-Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <form class="offcanvas-body">
                        <div class="mb-3">
                            <label class="col-form-label-sm">Category <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-control form-control-sm" type="text"
                                placeholder="Category">
                                <option value="">choose one...</option>
                            </select>
                            <small class="text-danger"></small>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label-sm">Sub-Category <span class="text-danger">*</span></label>
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
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offCanEditSub"
                    aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title">Edit Sub-Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <form class="offcanvas-body">
                        <div class="mb-3">
                            <label class="col-form-label-sm">Category</label>
                            <select name="category_id" class="form-control form-control-sm" type="text"
                                placeholder="Category" disabled>
                                <option value="">choose one...</option>
                            </select>
                            <small class="text-danger"></small>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label-sm">Sub-Category <span class="text-danger">*</span></label>
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
                            <label class="col-form-label-sm">Icon </label>
                            <input name="logo" class="form-control form-control-sm" type="file">
                            <small class="text-danger"></small>
                        </div>

                        <button class="btn btn-primary" type="submit">Update</button>
                    </form>
                </div>


                <hr>
            </div>
            <div class="row py-2 px-1" id="main_con">
                <div class="float">

                </div>
            </div>

        </div>
    </div>




</body>
<script src="/script/jquery-3.7.1.min.js"></script>
<script src="/script/popper.min.js"></script>
<script src="/script/bootstrap.min.js"></script>
<script src="/script/script2.js"></script>
<script src="/script/admin.js"></script>
<script src="/script/admin_categories.js"></script>
<script>

</script>

</html>