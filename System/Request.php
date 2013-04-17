<?php

namespace System;

class Request {
    
    private static $segments = array();
    private static $base_url = "";
    private static $method = "";
    
    public static function init() {
        /**
         * URI
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
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://';
        $domain = $_SERVER['HTTP_HOST'];
        static::$base_url .= $protocol . $domain . $folder;
        
        /**
         * method
         */
        static::$method = strtolower($_SERVER['REQUEST_METHOD']);
    }
    
    public static function getSegment($id) {
        if (array_key_exists($id, static::$segments))
            return static::$segments[$id];
        
        return false;
        
    }
    
    public static function getSegments() {
        return static::$segments;
    }

    public static function getBaseURL() {
        return static::$base_url;
    }
    
    public static function getMethod() {
        return static::$method;
    }
    
    public static function controller() {
        if (isset(static::$segments[0]))
            return static::$segments[0];
        
        return false;
    }
    
    public static function action() {
        if (isset(static::$segments[1]))
            return static::$segments[1];
        
        return false;
    }
    
}