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
    <link rel="stylesheet" href="../style/cart.css" />
    <title>ArtGhor | Cart</title>
</head>

<body>
    <?php require_once 'navbar.php' ?>
    <div class="container">
        <ul id="breadcrumb">
            <li><a href="/"><i class="fa-solid fa-house"></i> Home</a></li>
            <li><a href="/"><i class="fa-solid fa-cart-shopping"></i> Cart</a></li>
        </ul>
        <div class="row mx-0">
            <div class="col-xl-8 p-0 pe-xl-1 carts-con">
                <div class="head mybg">
                    <div class="form-check my-auto">
                        <label for="" id="select_all_text">Select All</label>
                        <input class="form-check-input" id="select_all" type="checkbox" checked />
                    </div>
                </div>
            </div>

            <div class="col-xl-4 p-0 ps-xl-0 mt-xl-0 mt-2">
                <div class="mybg summary p-3">
                    <h6>Cart Summary</h6>
                    <hr>
                    <div class="sum-row">
                        <span>Subtotal</span>
                        <span class="sub-total">৳ 500</span>
                    </div>
                    <div class="sum-row">
                        <span>Tax</span>
                        <span>৳ 0</span>
                    </div>
                    <div class="sum-row">
                        <span>Delivery Fee</span>
                        <span class="dv-fee" amount="0">৳ 60</span>
                    </div>
                    <hr>
                    <div class="sum-row">
                        <span>Total</span>
                        <span class="total">৳ 60</span>
                    </div>
                    <div class="sum-row">
                        <button class="btn-checkout"><i class="fa-brands fa-shopify"></i> Check Out</button>
                    </div>

                </div>
            </div>
        </div>
    </div>




    <?php require_once 'footer.php' ?>
</body>
<script src="../script/jquery-3.7.1.min.js"></script>
<script src="../script/popper.min.js"></script>
<script src="../script/bootstrap.min.js"></script>
<script src="../script/script.js"></script>
<script src="../script/cart.js"></script>
<script>
    on_page_load('user', true);
</script>

</html>