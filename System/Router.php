<?php

namespace System;

class Router {

    public static function loadController() {

        // controller
        $properName = '';

        if (Url::getSegment(0)) {
            $properName = ucfirst(strtolower(Url::getSegment(0)));
        } else {
            $properName = ucfirst(DEFAULT_PAGE);
        }

        $file = CONTROLLER_DIR . $properName . '.php';
        $controllerName = '\\Controller\\' . $properName;

        // request
        $request = '';

        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $request = 'post';
        } else {
            $request = 'get';
        }

        // action
        $action = '';

        if (Url::getSegment(1)) {
            $action = ucfirst(strtolower(Url::getSegment(1)));
        } else {
            $action = ucfirst(DEFAULT_ACTION);
        }

        // request fuggo metodus
        $method = $request . $action;

        if (is_file($file)) {
            $controller = new $controllerName;

            // metodus futtatasa :)
            if (method_exists($controller, $method)) {
                $controller->$method();
            } else {
                throw new \Exception('Oldal nem talalhato', '404');
            }
        } else {
            throw new \Exception('Oldal nem talalhato', '404');
        }
    }

}