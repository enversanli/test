<?php
require_once('src/Http/IdGenerator.php');

$route =  $_SERVER['REQUEST_URI'];
$method =  $_SERVER['REQUEST_METHOD'];


switch ($route){
    case $method == 'GET' &&$route == '/generate' :
        require_once "views/upload.html";
        break;
    case $method == 'POST' && $route == '/upload' :
        $generator = (new \Semrush\HomeTest\Http\IdGenerator());

        $generator->generate();
        break;

    default:
        echo "Uri cannot be found.";
        break;
}
