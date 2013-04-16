<?php

require 'init.php';

//var_dump(Router::segment(0));
//var_dump(Session::getAll());

try {
    System\Router::loadController();
} catch (Exception $e) {
    switch ($e->getCode()) {
        
        // Statusz kodokrol bovebben: http://en.wikipedia.org/wiki/List_of_HTTP_status_codes
        case 404:
            echo '<h3>404</h3><p>A kért oldal nem található!</p>';
            break;
        case 401:
            echo '<h3>401</h3><p>Authentikáció sikertelen!</p>';
            break;
        case 403:
            echo '<h3>403</h3><p>Hozzáférés megtagadva!</p>';
            break;
        default:
            echo '<h3>500</h3><p>Fogalmunk sincs mi a baj o.O</p>';
            break;
    }
}