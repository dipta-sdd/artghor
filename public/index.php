<?php

$request =  trim($_SERVER['REQUEST_URI'], '/');
$requests = explode('?', $request);

if (strpos($requests[0], 'api/') === 0) {
    require __DIR__ . '/index_api.php';
}


switch ($requests[0]) {
    case '':
        require __DIR__ . '/views/home.html';
        break;
    case '/':
        require __DIR__ . '/views/home.html';
        break;
    case 'login':
        require __DIR__ . '/views/login.html';
        break;
    case 'signup':
        require __DIR__ . '/views/signup.html';
        break;
    case 'forget-password':
        require __DIR__ . '/views/forge_password.html';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';

        break;
}
