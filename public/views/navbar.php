<!-- start navbar -->
<div id="nav_con">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="../images/logo.svg" alt="">
                    <strong>ArtGhor</strong></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto mb-2 mb-lg-0 me-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/cart"><i
                                    class="fa-solid fa-cart-shopping"></i></a>
                        </li>
                        <li class="nav-item logged-out">
                            <a class="nav-link" aria-current="page" href="/login">Login</a>
                        </li>
                        <li class="nav-item logged-out">
                            <a class="nav-link " aria-current="page" href="/signup">Sign Up</a>
                        </li>
                        <!-- <li class="nav-item logged-in d-none">
                            <a class="nav-link logout" aria-current="page" href="/#">Logout</a>
                        </li> -->
                        <li class="nav-item dropdown logged-in d-none">
                            <a class="nav-link dropdown-toggle user" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Dropdown link
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/profile"><i class="fa-solid fa-id-card"></i> My
                                        Profile</a></li>
                                <li><a class="dropdown-item" href="/cart"><i class="fa-solid fa-cart-shopping"></i> My
                                        Cart</a></li>
                                <li><a class="dropdown-item" href="/order"><i class="fa-regular fa-credit-card"></i> My
                                        Orders</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item logout" href="/logout"><i
                                            class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                            </ul>
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


<!-- end navbar -->
<!-- start loader -->
<div class="spinner_con">
    <div class="spinner"></div>
</div>



<!-- end loader -->