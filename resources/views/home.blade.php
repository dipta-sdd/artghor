<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style/bootstrap.min.css" />
    <link rel="stylesheet" href="../style/home.css" />
    <title>ArtGhor</title>
</head>

<body>
    <div id="nav_con">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#"><strong>ArtGhor</strong></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav m-auto mb-2 mb-lg-0 me-0">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="/cart">Cart</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="/login">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="/cart">Sign Up</a>
                            </li>
                        </ul>
                        <form class="d-flex justify-content-end ">
                            <input class="form-control " type="text" placeholder="Search">
                            <button class="btn" type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div class="container bg-light px-3 py-1">

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
    <div class="container bg-light" style="overflow: hidden;">
        <div class="row mx-0 bg-danger">
            <div class="col-4 bg-primary">ffggf</div>
        </div>
    </div>

</body>
<script src="../script/jquery-3.7.1.min.js"></script>
<script src="../script/popper.min.js"></script>
<script src="../script/bootstrap.min.js"></script>
<script src="../script/home.js"></script>
<script>

</script>

</html>