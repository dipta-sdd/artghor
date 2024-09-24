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
    <link rel="stylesheet" href="../style/checkout.css" />
    <title>ArtGhor</title>
</head>

<body>
    <?php require_once 'navbar.php' ?>

    <div class="container">
        <ul id="breadcrumb">
            <li><a href="/"><i class="fa-solid fa-house"></i> Home</a></li>
            <li><a href="/"><i class="fa-solid fa-cart-shopping"></i> Cart</a></li>
            <li><a href="#"><i class="fa-solid fa-truck"></i> Order</a></li>
        </ul>
        <div class="row mx-0 form">
            <div class="col-lg-8 p-0 pe-xl-1 address">
                <div class="mybg p-3">
                    <h5>Confirm Delivery Address</h5>
                    <hr>
                    <div class="row">
                        <div class="col-xl-6 mb-3">
                            <label class="form-label required">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Your name">
                        </div>
                        <div class="col-xl-6"></div>
                        <div class="col-xl-6 mb-3">
                            <label class="form-label required">Mobile</label>
                            <input type="number" name="mobile" class="form-control" placeholder="Your name">
                        </div>
                        <div class="col-xl-6 mb-3">
                            <label class="form-label required">District</label>
                            <input type="text" name="district" class="form-control" placeholder="Your name"
                                value="Sylhet" disabled>
                        </div>
                        <div class="col-xl-6 mb-3">
                            <label class="form-label required">Thana / Upazila</label>
                            <input type="text" name="thana" class="form-control" placeholder="Your name"
                                value="Sylhet Sadar" disabled>
                        </div>

                        <div class="col-xl-6 mb-3">
                            <label class="form-label required">Area</label>
                            <select type="text" name="area" class="form-control" placeholder="Your name">


                                <option>Choose One</option>
                                <option value="Akhalia">Akhalia</option>

                                <option value="Alampur">Alampur</option>

                                <option value="Ambarkhana">Ambarkhana</option>

                                <option value="Badam Bagicha">Badam Bagicha</option>

                                <option value="Baghibari">Baghibari</option>

                                <option value="Bhatalia">Bhatalia</option>

                                <option value="Bilpar">Bilpar</option>
                                <option value="Bimanbondar Road">Bimanbondar Road</option>
                                <option value="Biman Bondar">Biman Bondar</option>

                                <option value="Boroikandi">Boroikandi</option>

                                <option value="Charadigirpar">Charadigirpar</option>

                                <option value="Chondan Tula">Chondan Tula</option>

                                <option value="Choukidighi">Choukidighi</option>

                                <option value="Daptari Para">Daptari Para</option>

                                <option value="Dargah Mahalla">Dargah Mahalla</option>

                                <option value="Darjee Band">Darjee Band</option>

                                <option value="Dattapara">Dattapara</option>

                                <option value="Gasitula">Gasitula</option>

                                <option value="Golapganj">Golapganj</option>

                                <option value="Haripur">Haripur</option>

                                <option value="Hatimbagh">Hatimbagh</option>

                                <option value="Hauldar Para">Hauldar Para</option>

                                <option value="Hawapara">Hawapara</option>

                                <option value="Jalalabad">Jalalabad</option>

                                <option value="Jalalabad Cantonment">Jalalabad Cantonment</option>

                                <option value="Jamtala">Jamtala</option>

                                <option value="Jherjheri Para">Jherjheri Para</option>

                                <option value="Jointapur">Jointapur</option>

                                <option value="Kadamtali">Kadamtali</option>

                                <option value="Kahar Para">Kahar Para</option>

                                <option value="Kajal Shah">Kajal Shah</option>

                                <option value="Kalapara">Kalapara</option>

                                <option value="Kalighat">Kalighat</option>

                                <option value="Kamalbazer">Kamalbazer</option>

                                <option value="Kanisail">Kanisail</option>

                                <option value="Kazi Jalaluddin Mahalla">Kazi Jalaluddin Mahalla</option>

                                <option value="Keyapara">Keyapara</option>

                                <option value="Khadimnagar">Khadimnagar</option>

                                <option value="Khadim Para">Khadim Para</option>

                                <option value="Kharadi Para">Kharadi Para</option>

                                <option value="Khasdobir">Khasdobir</option>

                                <option value="Khujarkhola">Khujarkhola</option>

                                <option value="Korarpar">Korarpar</option>

                                <option value="Kuarpar">Kuarpar</option>

                                <option value="Kuliapara">Kuliapara</option>

                                <option value="Kurshi Ghat">Kurshi Ghat</option>

                                <option value="Lakri Para">Lakri Para</option>

                                <option value="Lala Bazar">Lala Bazar</option>

                                <option value="Lalbazar">Lalbazar</option>

                                <option value="Lal Dighirpar">Lal Dighirpar</option>

                                <option value="Lama Bazar">Lama Bazar</option>

                                <option value="Lawai">Lawai</option>

                                <option value="Majumder Para">Majumder Para</option>

                                <option value="Mazumdari">Mazumdari</option>

                                <option value="Mirapara">Mirapara</option>

                                <option value="Mir Boxtula">Mir Boxtula</option>

                                <option value="Mirza Jangal">Mirza Jangal</option>

                                <option value="Modhu Shahid">Modhu Shahid</option>

                                <option value="Mominkhola">Mominkhola</option>

                                <option value="Mongla">Mongla</option>

                                <option value="Mulla Para">Mulla Para</option>

                                <option value="Munshipara">Munshipara</option>

                                <option value="Nabab Road">Nabab Road</option>

                                <option value="Nehari Para">Nehari Para</option>

                                <option value="Noapara">Noapara</option>

                                <option value="Pathan Tula">Pathan Tula</option>

                                <option value="Pir Mahalla">Pir Mahalla</option>

                                <option value="Ponitula">Ponitula</option>

                                <option value="Puran Lane">Puran Lane</option>

                                <option value="Rajargali">Rajargali</option>

                                <option value="Raj Bari">Raj Bari</option>

                                <option value="Rajpara">Rajpara</option>

                                <option value="Ranga Hajiganj">Ranga Hajiganj</option>

                                <option value="Sabuj Bagh">Sabuj Bagh</option>

                                <option value="Sadatikar">Sadatikar</option>

                                <option value="Sadipur">Sadipur</option>

                                <option value="Sagardigir Par">Sagardigir Par</option>

                                <option value="Sarderpar">Sarderpar</option>

                                <option value="Shahajalal University">Shahajalal University</option>

                                <option value="Shaplabagh">Shaplabagh</option>

                                <option value="Shenpara">Shenpara</option>

                                <option value="Shibganj - Khoradi Para">Shibganj - Khoradi Para</option>

                                <option value="Silam">Silam</option>



                                <option value="Sylhet Sadar Upazilla Office">Sylhet Sadar Upazilla Office</option>

                                <option value="Taltola Road">Taltola Road</option>

                                <option value="Tero Ratan">Tero Ratan</option>

                                <option value="Tilagor - Tatipara">Tilagor - Tatipara</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label required">Thana / Upazila</label>
                            <textarea type="text" name="address" class="form-control"
                                placeholder="House No, Street"></textarea>
                        </div>
                    </div>


                </div>
            </div>
            <div class="col-lg-4  p-0 ps-xl-0 mt-xl-0 mt-2">
                <div class="mybg summary p-3">
                    <h6>Order Summary</h6>
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
                        <span class="dv-fee" amount="60">৳ 60</span>
                    </div>
                    <hr>
                    <div class="sum-row">
                        <span>Total</span>
                        <span class="total">৳ 60</span>
                    </div>
                    <div class="sum-row payment">
                        <span>Payment Method</span>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="Cash On Delevery" name="payment_type">
                            <label class="form-check-label">
                                Cash On Delivery
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="Bkash" name="payment_type" checked>
                            <label class="form-check-label">
                                Bkash
                            </label>
                        </div>
                        <div class="collapse" id="collapse">
                            <div class="card card-body">
                                Payment Instruction.
                                <div class="mt-2 mb-2">
                                    <label class="form-label required">Bkash No</label>
                                    <input type="number" name="bkash_no" class="form-control" placeholder="01xxxxxxxxx">
                                </div>
                                <div class="mb-0">
                                    <label class="form-label">Transaction ID</label>
                                    <input type="text" name="trans_id" class="form-control" placeholder="TrxID">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="sum-row">
                        <button class="btn-confirm">
                            <i class="fa-solid fa-truck"></i>
                            Order Now</button>
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
<script src="../script/checkout.js"></script>
<script>
// $(".spinner_con").css("display", "none");
</script>

</html>