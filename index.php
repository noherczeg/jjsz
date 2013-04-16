<?php

require 'init.php';

//var_dump(Router::segment(0));
//var_dump(Session::getAll());

try {
    System\Router::loadController();
} catch (Exception $e) {
    if ($e->getCode() == 404) {
        echo '<h3>404 - A kért oldal nem található!</h3>';
    }
}