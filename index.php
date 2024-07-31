<?php

$request =  trim($_SERVER['REQUEST_URI'], '/');
$requests = explode('?', $request);

require __DIR__ . '/public/index.php';
