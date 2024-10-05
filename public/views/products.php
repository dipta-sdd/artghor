<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="icon" type="image/x-icon" href="../images/favicon.svg"> -->
    <link rel="stylesheet" href="../style/bootstrap.min.css" />
    <link rel="stylesheet" href="../style/style.css" />
    <link rel="stylesheet" href="../style/products.css" />
    <title>ArtGhor</title>
</head>

<body>
    <?php require_once 'navbar.php' ?>

    <div class="container">
        <ul id="breadcrumb">
            <li><a href="/"><i class="fa-solid fa-house"></i> Home</a></li>
            <li><a href="/products"><i class="fa-solid fa- "></i> Products</a></li>
        </ul>
        <div class="row mybg mx-0 my-2">
            <div class="d-flex top">
                <div class="filters">
                    <label for="sortBy" class="form-label">Sort By <i class="fa-solid fa-sort"></i> : &nbsp;</label>
                    <select class="form-control" id="sortBy" name="sort">
                        <option value="name-asc">Name: A-Z</option>
                        <option value="name-desc">Name: Z-A</option>
                        <option value="price-desc">Price: High-Low</option>
                        <option value="price-asc">Price: Low-High</option>
                        <option value="created_at-desc">Newest First</option>
                        <option value="created_at-asc">Oldest First</option>
                    </select>
                </div>

                <div class="filters">
                    <label for="filterBy" class="form-label">Filter By <i class="fa-solid fa-filter"></i> : &nbsp;
                    </label>
                    <select class="form-control" id="filterByForProductsPage" name="filter">
                        <option value="">All</option>
                    </select>
                </div>
                <div class="filters">
                    <label for="limit" class="form-label">Per Page <i class="fa-solid fa-list-ol"></i> :
                        &nbsp;</label>
                    <select class="form-control" id="limit" name="limit">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="section" id="prod_con">
            <div class="d-flex">


            </div>
        </div>

        <div class="row mx-0">
            <div class="col-12">
                <nav aria-label="...">
                    <ul class="pagination justify-content-end">

                    </ul>
                </nav>
            </div>
        </div>

    </div>




    <?php require_once 'footer.php' ?>
</body>
<script src="../script/jquery-3.7.1.min.js"></script>
<script src="../script/popper.min.js"></script>
<script src="../script/bootstrap.min.js"></script>
<script src="../script/script.js"></script>
<script src="../script/products.js"></script>
<script>
    on_page_load('');
    // $(".spinner_con").css("display", "none");
</script>

</html>