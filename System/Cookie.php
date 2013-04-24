<?php

namespace System;

class Cookie {

    public static function get($name) {
        if (isset($_COOKIE[$name])) {
            return filter_var($_COOKIE[$name], FILTER_SANITIZE_STRING);
        }
        
        throw new Exception("Nincs ilyen nevvel sutink!");
    }
    
    public static function getAll() {
        return $_COOKIE;
    }
    
    public static function set($name, $value, $expire) {
        setcookie($name, $value, $expire);
    }
    
    public static function is_set($name) {
        if (isset($_COOKIE[$name]))
            return true;
        return false;
    }
}