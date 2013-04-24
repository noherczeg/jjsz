<?php

namespace System;

class Auth {
    
    private static $user = null;
    
    public static function check() {
        if (isset(static::$user))
            return true;
        return false;
    }
    
    public static function login($name, $pass) {
        $params = array(
            ':name' => filter_var($name, FILTER_SANITIZE_STRING),
            ':password' => filter_var($pass, FILTER_SANITIZE_STRING)
        );
        $query = Database::query("SELECT * FROM user WHERE name=:name AND password=:password", $params);
        $user = $query->fetch(\PDO::FETCH_OBJ);
        
        if ($user) {
            static::$user = $user;
        } else {
            throw new Exception("Login failed!");
        }
        
        header("Location: " . Request::getBaseURL());
    }
    
    public static function logout() {
        static::$user = null;
        header("Location: " . Request::getBaseURL());
    }
    
}