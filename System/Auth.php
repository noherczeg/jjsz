<?php

namespace System;

class Auth {
    
    private static $user = null;
    
    public static function init() {
        if(Session::get('user'))
            static::$user = Session::get('user');
    }
    
    public static function getUser() {
        return static::$user;
    }

    public static function check() {
        if (isset(static::$user))
            return true;
        return false;
    }
    
    public static function login($name, $pass) {
        $params = array(
            ':name' => filter_var($name, FILTER_SANITIZE_STRING),
            ':password' => md5(filter_var($pass, FILTER_SANITIZE_STRING))
        );
        $query = Database::query("SELECT * FROM users WHERE name=:name AND password=:password", $params);
        $user = $query->fetch(\PDO::FETCH_OBJ);
        
        if ($user) {
            static::$user = $user;
            Session::set('user', $user);
        } else {
            throw new \Exception("Login failed!");
        }
        
        header("Location: " . Request::getBaseURL());
    }
    
    public static function logout() {
        static::$user = null;
        Session::remove('user');
        header("Location: " . Request::getBaseURL());
    }
    
    public static function register($name, $pass) {
        $params = array(
            ':name' => filter_var($name, FILTER_SANITIZE_STRING),
            ':password' => md5(filter_var($pass, FILTER_SANITIZE_STRING))
        );
        
        $query = Database::query("INSERT INTO user (name, password) VALUES(:name, :password)", $params);
    }
    
}