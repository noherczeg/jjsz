<?php

namespace System;

class Database {
    
    private static $settings = array();
    private static $pdo = null;
    
    public static function init($iniFile) {
        static::$settings = parse_ini_file($iniFile);
        
        static::$pdo = new \PDO(
            static::$settings['driver'] . ':host=' . static::$settings['host'] . ';dbname=' . static::$settings['dbname']
            , static::$settings['username']
            , static::$settings['password']);
        
        static::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        
    }
    
    public static function query($queryString, $params = null) {
        try {
            static::$pdo->beginTransaction();
            
            $stmt = static::$pdo->prepare($queryString);
            $stmt->execute($params);
            
            static::$pdo->commit();
            
            return $stmt;
            
        } catch (\Exception $e) {
            echo 'Hiba tranzakcio kozben: ' . $e->getMessage();
            static::$pdo->rollBack();
        }
        
    }
    
}