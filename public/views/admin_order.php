<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/x-icon" href="../images/favicon.svg">
    <link rel="stylesheet" href="/style/bootstrap.min.css" />
    <link rel="stylesheet" href="/style/style.css" />
    <link rel="stylesheet" href="/style/admin.css" />
    <link rel="stylesheet" href="/style/admin_order.css" />
    <title>ArtGhor</title>
</head>

<body>
    <?php require_once 'navbar_admin.php' ?>
    <div class="body-con">
        <div class="sidebar con">
            <div class="con">
                <?php require_once 'sidebar.php' ?>
            </div>
        </div>
        <div class="admin-body">
            <div class="col-12" id="dashboard_header">
                <h4>Order Details</h4>

                <hr>
            </div>
            <div class="row pt-2" id="main_con">
                <div class="col-12 bg-border py-2">
                    <table class="header">
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="items table-responsive my-2">
                    <table class="table table-striped table-bordered align-middle mb-0">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th style="width: 2.1rem">Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Sub-Category</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <!-- <th style="min-width:11em">Status</th> -->
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                        </tbody>
                    </table>


                </div>

            </div>
        </div>
    </div>






</body>
<script src="/script/jquery-3.7.1.min.js"></script>
<script src="/script/popper.min.js"></script>
<script src="/script/bootstrap.min.js"></script>
<script src="/script/script2.js"></script>
<script src="/script/admin.js"></script>
<script src="/script/admin_order.js"></script>
<script>
    on_page_load('');
    // $(".spinner_con").css("display", "none");
</script>

</html>