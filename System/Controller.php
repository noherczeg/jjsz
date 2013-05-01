<?php

namespace System;

class Controller {
    
    protected $data = array();

    public function __construct() {
        $this->data['user'] = Session::get('user');
    }
    
}