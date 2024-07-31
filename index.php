<?php

$request =  trim($_SERVER['REQUEST_URI'], '/');
$requests = explode('?', $request);
// echo $_SERVER['REQUEST_URI'];
switch ($requests[0]) {
    case '/api':
        require __DIR__ . '/public/index.php';
        break;
    default:
        require __DIR__ . '/public/index_front.php';

        break;
}
