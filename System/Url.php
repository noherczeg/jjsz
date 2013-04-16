<?php

namespace System;

class Url {
    
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
    
    public static function getSegment($id) {
        if (array_key_exists($id, static::$segments)) {
            return static::$segments[$id];
        } else {
            return false;
        }
    }
    
    public static function getSegments() {
        return static::$segments;
    }

    public static function getBaseURL() {
        return static::$base_url;
    }
    
}