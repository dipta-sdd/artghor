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
    <link rel="stylesheet" href="../style/login.css" />
    <title>ArtGhor</title>
</head>

<body>

    <div class="con-img">
        <?php require_once 'navbar.php' ?>
        <img src="../images/svg/17213505_v911-a-13 copy.svg" alt="">
        <div class="con-abs">
            <div class="con-form">
                <div class="left">
                    <img src="../images/logo.svg" alt="">
                    <span>Tag line.</span>
                </div>
                <div class="right">
                    <form action="" class="" autocomplete="new-password" id="login">
                        <h3>Log In</h3>
                        <label for="">Email or Phone or Username</label>
                        <input type="text" name="email" class="input email" autocomplete="new-password"
                            placeholder="Email/Phone/Username" />
                        <label for="">Password</label>
                        <input type="password" name="password" placeholder="Password" autocomplete="new-password"
                            class="input pass" />
                        <button class="login">Log In</button>
                        <span>
                            <a href="/forget-password">Forget Password</a>
                            <a href="/signup">Sign Up</a>
                        </span>

                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="../script/jquery-3.7.1.min.js"></script>
<script src="../script/popper.min.js"></script>
<script src="../script/bootstrap.min.js"></script>
<script src="../script/script.js"></script>
<script src="../script/login.js"></script>
<script>
    on_page_load('!auth');
</script>


</html>