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
    <link rel="stylesheet" href="../style/order.css" />
    <title>ArtGhor | Order</title>
</head>

<body>
    <?php require_once 'navbar.php' ?>
    <div class="container">
        <ul id="breadcrumb">
            <li><a href="/"><i class="fa-solid fa-house"></i> Home</a></li>
            <li><a href="/profile"><i class="fa-solid fa-user"></i> Profile</a></li>
            <li><a href="/#"><i class="fa-solid fa-truck"></i> Order</a></li>
        </ul>
        <div class="row mx-0 orders-con">
            <!--  -->

            <div class="mybg d-flex top mb-1">
                <div class="filters">
                    <label for="sortBy" class="form-label">Sort By <i class="fa-solid fa-sort"></i> : &nbsp;</label>
                    <select class="form-control" id="sortBy" name="sort">
                        <option value="desc">Newest First</option>
                        <option value="asc">Oldest First</option>
                    </select>
                </div>
                <div class="filters">
                    <label class="form-label">Filters <i class="fa-solid fa-filter"></i> : &nbsp;</label>
                    <div class=" form-check">
                        <input class="form-check-input" name="filter" type="checkbox" value="pending">
                        <label class="form-check-label" for="filter-all"> Pending </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="filter" type="checkbox" value="processing">
                        <label class="form-check-label" for="filter-pending"> Processing </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="filter" type="checkbox" value="out for delivery">
                        <label class="form-check-label" for="filter-shipped"> Out for delivery </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="filter" type="checkbox" value="delivered">
                        <label class="form-check-label" for="filter-delivered"> Delivered </label>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!--  -->
    </div>
    </div>




    <?php require_once 'footer.php' ?>
</body>
<script src="../script/jquery-3.7.1.min.js"></script>
<script src="../script/popper.min.js"></script>
<script src="../script/bootstrap.min.js"></script>
<script src="../script/script.js"></script>
<script src="../script/orders.js"></script>
<script>

</script>

</html>