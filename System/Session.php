<?php

namespace System;

class Session {

    public static function init() {
        if (isset($_SESSION['LAST_ACTIVITY']) && time() - $_SESSION['LAST_ACTIVITY'] > SESSION_TIMEOUT) {
            session_unset();
            session_destroy();
        }
        
        session_start();
        $_SESSION['LAST_ACTIVITY'] = time();
        
    }

    public static function get($element) {
        if (!array_key_exists($element, $_SESSION))
            return null;
        
        return $_SESSION[$element];
    }

    public static function getAll() {
        return $_SESSION;
    }

    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function remove($key) {
        if (!array_key_exists($key, $_SESSION)) {
            throw new \Exception('A kert session elem nem talalhato, nem torolheto: ' . $element);
        }
        
        unset($_SESSION[$key]);
    }

}