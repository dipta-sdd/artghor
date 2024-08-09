<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                    <form action="" class="" autocomplete="new-password" id="signup">
                        <h3>Sign Up</h3>
                        <span class="error"></span>
                        <label for="">Email <b class="text-danger">*</b></label>
                        <input type="email" name="email" class="input email" autocomplete="new-password" placeholder="email@email.com" />
                        <label for="">Phone <b class="text-danger">*</b></label>
                        <input type="number" name="mobile" class="input mobile" autocomplete="new-password" placeholder="01000000000" />


                        <label for="">Name <b class="text-danger">*</b></label>
                        <input type="text" name="name" class="input name" autocomplete="new-password" placeholder="Jhon Dave" />
                        <label for="">Username <b class="text-danger">*</b></label>
                        <input type="text" name="username" class="input username" autocomplete="new-password" placeholder="username" />

                        <label for="">Password <b class="text-danger">*</b></label>
                        <input type="password" name="password" placeholder="Password" autocomplete="new-password" class="input pass" />
                        <label for="">Confirm Password <b class="text-danger">*</b></label>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" autocomplete="new-password" class="input pass" />

                        <button class="login">Sign Up</button>
                        <span>
                            <a href="/forge-password">Forge Password</a>
                            <a href="/login">Log In</a>
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
<script src="../script/signup.js"></script>
<script>
    on_page_load('!auth');
</script>


</html>