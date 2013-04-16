<?php

namespace System;

class Model {

    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function __get($name) {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }

}