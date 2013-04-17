<?php

namespace System;

class View {

    private static $path = '';
    private static $content = null;

    public static function init($path) {
        static::$path = $path;
    }

    public static function make($script, array $vars = array()) {
        $view_file = static::$path . $script;
        
        if (!is_file($view_file)) {
            throw new Exception('Nem talalom a megadott view-t: ' . $view_file);
        }
        
        extract($vars);

        // output buffer bekapcs, ebbe tesszuk a tartalmat!
        ob_start();
        include $view_file;
        static::$content = ob_get_clean();
    }
    
    public static function render() {
        echo static::$content;
    }

}