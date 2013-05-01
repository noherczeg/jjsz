<?php

namespace Controller;

class Register extends \System\Controller {
    
    public function getIndex() {
        \System\View::make('register/form.php');
    }
    
    public function postIndex() {
        //var_dump($_POST);
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $pass = md5(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
        \System\Auth::register($name, $pass);
        
        header('Location: ' . \System\Request::getBaseURL());
    }
    
}