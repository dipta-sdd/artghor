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
        default:
            http_response_code(404);
            require __DIR__ . '/views/404.php';

            break;
    }
}
