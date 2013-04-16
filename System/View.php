<?php

namespace System;

class View {

    private $path = '';

    public function __construct($path) {
        $this->path = $path;
    }

    public function render($script, array $vars = array()) {
        $view_file = $this->path . $script;
        
        if (!is_file($view_file)) {
            throw new Exception('Nem talalom a megadott view-t: ' . $view_file);
        }
        
        $filtered = array();
        
        foreach ($vars as $key => $var) {
            $filtered[$key] = filter_var($var, FILTER_SANITIZE_STRING);
        }
        
        extract($filtered);

        ob_start();
        include $view_file;
        echo ob_get_clean();
    }

}