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
                    <form action="" class="" autocomplete="new-password" id="otp">
                        <h3>Log In</h3>
                        <label for="">Enter Your Verification Code</label>
                        <span class="time">Your OTP will be expired in 05m 00s.</span>
                        <span>
                            <input type="text" pattern="\d" class="input" maxlength="1" autocomplete="new-password" />
                            <input type="text" pattern="\d" class="input" maxlength="1" autocomplete="new-password" />
                            <input type="text" pattern="\d" class="input" maxlength="1" autocomplete="new-password" />
                            <input type="text" pattern="\d" class="input" maxlength="1" autocomplete="new-password" />
                            <input type="text" pattern="\d" class="input" maxlength="1" autocomplete="new-password" />
                            <input type="text" pattern="\d" class="input" maxlength="1" autocomplete="new-password" />
                        </span>
                        <span class="error"></span>


                        <button class="login">Continue</button>
                        <a href="#Resend" class="disabled">Resend OTP in 03m 00s.</a>

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
<script src="../script/otp.js"></script>
<script>
on_page_load('otp');
</script>


</html>