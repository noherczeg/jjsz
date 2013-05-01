<?php

namespace Controller;

class Blog extends \System\Controller {
    
    public function getIndex() {
        if (\System\Auth::check()) {
            var_dump($this->data['user']);
        } else {
            var_dump('nem vagy belepve!');
        }
    }
    
}