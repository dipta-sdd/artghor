<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/x-icon" href="../images/favicon.svg">
    <link rel="stylesheet" href="../style/bootstrap.min.css" />
    <link rel="stylesheet" href="../style/style.css" />
    <link rel="stylesheet" href="../style/admin.css" />
    <link rel="stylesheet" href="../style/products_admin.css" />
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
                <h4>All Products</h4>
                <hr>
            </div>
            <div class="row pt-2" id="main_con">

                <div class="col-12 filter-con bg-border">
                    <div class=" filter my-1">
                        <div class="input-group my-2">
                            <span class="input-group-text"><i class="fa-solid fa-sort"></i> &nbsp; Sort By</i></span>
                            <select type="text" class="form-control" name="sort" id="sort">
                                <option value="name-asc" selected>Name : A-Z</option>
                                <option value="name-desc">Name : Z-A</option>
                                <option value="price-desc">Price : High - Low</option>
                                <option value="price-asc">Price : Low - High</option>
                                <option value="stock-desc">Stock : High - Low</option>
                                <option value="stock-asc">Stock : Low - High</option>
                            </select>
                        </div>
                    </div>
                    <div class=" filter my-1">
                        <div class="input-group my-2">
                            <span class="input-group-text"><i class="fa-solid fa-sliders"></i> &nbsp;
                                Category</i></span>
                            <select type="text" class="form-control" name="category" id="category">
                                <option value="" selected>All</option>

                            </select>
                        </div>
                    </div>
                    <div class=" filter my-1">
                        <div class="input-group my-2">
                            <span class="input-group-text"><i class="fa-solid fa-list"></i></i> &nbsp; Per Page</span>
                            <select type="text" class="form-control" name="limit" id="limit">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>

                            </select>
                        </div>
                    </div>

                </div>

                <!-- <div class="col-12 my-2 table-con bg-border"> -->
                <div class=" table-responsive mb-3">
                    <table class="table table-striped table-bordered align-middle mb-0">
                        <thead class="">
                            <tr>
                                <th style="width: 2.1rem">Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Sub-Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <!-- <th style="min-width:11em">Status</th> -->
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">

                        </tbody>
                    </table>


                </div>
                <!-- </div> -->
                <div class="col-12">
                    <nav aria-label="...">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active" aria-current="page">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>






</body>
<script src="../script/jquery-3.7.1.min.js"></script>
<script src="../script/popper.min.js"></script>
<script src="../script/bootstrap.min.js"></script>
<script src="../script/script2.js"></script>
<script src="../script/admin.js"></script>
<script src="../script/products_admin.js"></script>
<script>

</script>

</html>