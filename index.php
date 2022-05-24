<?php
$route =  $_SERVER['REQUEST_URI'];
$method =  $_SERVER['REQUEST_METHOD'];

switch ($route){
    case $method == 'GET' &&$route == '/generate' :
        require_once "views/upload.html";
        break;
    case $method == 'POST' && $route == '/upload' :
        (new \Semrush\HomeTest\Http\IdGenerator())->generate();
        break;

    default:
        echo "Uri cannot be found.";
        break;
}
