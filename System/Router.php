<?php

namespace System;

class Router {

    public static function loadController() {

        // controller
        $properName = ucfirst(DEFAULT_PAGE);

        if (Request::controller())
            $properName = ucfirst(strtolower(Request::controller()));

        $file = CONTROLLER_DIR . $properName . '.php';
        $controllerName = '\\Controller\\' . $properName;

        // action
        $action = ucfirst(DEFAULT_ACTION);

        if (Request::action())
            $action = ucfirst(strtolower(Request::action()));

        // request fuggo metodus
        $method = Request::getMethod() . $action;

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