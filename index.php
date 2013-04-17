<?php

require 'init.php';

//var_dump(Router::segment(0));
//var_dump(Session::getAll());

try {
    System\Router::loadController();
} catch (Exception $e) {
    switch ($e->getCode()) {
        
        // Statusz kodokrol bovebben: http://en.wikipedia.org/wiki/List_of_HTTP_status_codes
        case 403:
            System\View::make('error/403.php');
            break;
        case 404:
            System\View::make('error/404.php');
            break;
        default:
            System\View::make('error/500.php');
            break;
    }
}

System\View::render();