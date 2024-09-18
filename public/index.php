<?php

$request =  trim($_SERVER['REQUEST_URI'], '/');
$requests = explode('?', $request);

if (strpos($requests[0], 'api/') === 0) {
    require __DIR__ . '/index_api.php';
} else {
    switch ($requests[0]) {
        case '':
            require __DIR__ . '/views/home.php';
            break;
        case '/':
            require __DIR__ . '/views/home.php';
            break;
        case 'login':
            require __DIR__ . '/views/login.php';
            break;
        case 'signup':
            require __DIR__ . '/views/signup.php';
            break;
        case 'otp':
            require __DIR__ . '/views/otp.php';
            break;
        case 'forget-password':
            require __DIR__ . '/views/forge_password.php';
            break;
            // admin 
        case 'dashboard':
            require __DIR__ . '/views/dashboard.php';
            break;
        case 'banners':
            require __DIR__ . '/views/banners.php';
            break;
        case 'admin/products':
            require __DIR__ . '/views/products_admin.php';
            break;
        case 'admin/product/add':
            require __DIR__ . '/views/add_product.php';
            break;
        case 'admin/categories':
            require __DIR__ . '/views/admin_categories.php';
            break;
        case 'admin/product':
            require __DIR__ . '/views/admin_product.php';
            break;



        case 'product':
            require __DIR__ . '/views/product.php';
            break;
        case 'cart':
            require __DIR__ . '/views/cart.php';
            break;
        case 'checkout':
            require __DIR__ . '/views/checkout.php';
            break;

        default:
            http_response_code(404);
            require __DIR__ . '/views/404.php';
            break;
    }
}
// AIzaSyASv - Rtz98Fobm5h4I62cZw2XUjXwuf1AQ
// google api key 