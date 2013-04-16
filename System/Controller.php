<?php

namespace System;

abstract class Controller {
    
    protected $data = array();
    protected $view = null;

    public function __construct() {
        $this->view = new \System\View(VIEWS_DIR);
    }
    
}