<?php

namespace System;

class Router {

    private static $segments = array();
    private static $base_url = "";

    public static function init() {
        /**
         * URI kinyerese
         */
        $uri = $_SERVER['QUERY_STRING'];

        if (strlen($uri) === 0 && isset($_SERVER['PATH_INFO'])) {
            $uri = $_SERVER['PATH_INFO'];
        } else {
            $uri = '';
        }

        /**
         * Felbontas "/"-enkent
         */
        static::$segments = preg_split('/\//', $uri, -1, PREG_SPLIT_NO_EMPTY);

        /**
         * bazis url
         */
        $folder = str_replace(START_FILE, '', $_SERVER['SCRIPT_NAME']);
        static::$base_url .= "http://" . $_SERVER['SERVER_NAME'] . "/" . $folder;
    }

    public static function segment($id) {
        return static::$segments[$id];
    }

    public static function baseURL() {
        return static::$base_url;
    }
    
    public static function loadController() {
        
        // controller
        $properName = '';
        
        if (isset(static::$segments[0])) {
            $properName = ucfirst(strtolower(static::$segments[0]));
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
        
        if (isset(static::$segments[1])) {
            $action = static::$segments[1];
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
            
        }
    }

}