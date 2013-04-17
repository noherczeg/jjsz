<?php

namespace System;

class Asset {
    
    private static $dir = '';
    
    public static function init($assetDir) {
        static::$dir = $assetDir;
    }
    
    public static function get($path) {
        $file = static::$dir . $path;
        
        if (!is_file($file))
            throw new Exception ('A kert asset nem talalhato: ' . $path);
        
        return Request::getBaseURL() . ASSET_DIR . DS . $path;
    }
    
}