<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20,100,1,200"
        rel="stylesheet" />
    <!-- <link rel="icon" type="image/x-icon" href="../images/favicon.svg"> -->
    <link rel="stylesheet" href="../style/bootstrap.min.css" />
    <link rel="stylesheet" href="../style/style.css" />
    <link rel="stylesheet" href="../style/home.css" />
    <title>ArtGhor</title>
</head>

<body>
    <?php require_once 'navbar.php' ?>

    <div class="bg-ban section">
        <div class="container bg-light" id="banner_con">
            <div id="banner_home" class="carousel slide" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-bs-target="#banner_home" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#banner_home" data-bs-slide-to="1"></li>
                    <li data-bs-target="#banner_home" data-bs-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <a href="/dev" class="carousel-item active">
                        <img class="d-block w-100" src="../images/Screenshot 2024-07-30 015339.png" alt="First slide">
                    </a>
                    <a href="/dev" class="carousel-item">
                        <img class="d-block w-100" src="../images/Screenshot 2024-07-30 015509.png" alt="Second slide">
                    </a>
                    <a href="/dev" class="carousel-item">
                        <img class="d-block w-100" src="../images/Screenshot 2024-07-30 015339.png" alt="Third slide">
                    </a>
                </div>
                <a class="carousel-control-prev" href="#banner_home" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#banner_home" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <div class="section" id="cat_con">
        <div class="container">
            <div class="sec-header">Categories</div>
            <div class="sec-header2">
                <div class="left">Browse Products By Category</div>
                <div class="right">
                    <span><i class="fa-solid fa-chevron-left"></i></span>
                    <span><i class="fa-solid fa-chevron-right"></i></span>
                </div>
            </div>
            <div class="d-flex">

            </div>
        </div>
    </div>
    <div class="section" id="prod_con">
        <div class="container">
            <div class="sec-header">Products</div>
            <div class="sec-header2">
                <div class="left">Browse All Products</div>
                <div class="right">
                    <span class="prev disabled"><i class="fa-solid fa-chevron-left"></i></span>
                    <span class="next"><i class="fa-solid fa-chevron-right"></i></span>
                </div>
            </div>
            <div class="d-flex">

            </div>
        </div>
    </div>
    <!-- <div class="container bg-light">
        <div class="row mx-0 bg-danger">
            <div class="col-4 bg-primary">ffggf</div>
        </div>
    </div> -->
    <?php require_once 'footer.php' ?>
</body>
<script src="../script/jquery-3.7.1.min.js"></script>
<script src="../script/popper.min.js"></script>
<script src="../script/bootstrap.min.js"></script>
<script src="../script/script.js"></script>
<script src="../script/home.js"></script>
<script>
    on_page_load('');
</script>

</html>