<?php

$request =  trim($_SERVER['REQUEST_URI'], '/');
$requests= explode('?',$request);
// echo $_SERVER['REQUEST_URI'];
switch ($requests[0]) {
    case '' :
        require __DIR__ . '/views/home.html';
        break;
    case '/' :
        require __DIR__ . '/views/home.html';
        break;
    default:
            http_response_code(404);
        require __DIR__ . '/views/404.php';
        
        break;
}

?>