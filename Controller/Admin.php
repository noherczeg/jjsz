<?php

namespace Controller;

class Admin extends \System\Controller {

    private function auth() {        
        if (!\System\Auth::check())
            header('Location: ' . \System\Request::getBaseURL() . 'admin/login');
    }
    
    public function getIndex() {
        $this->auth();
    }
    
    public function getNew() {
        $this->auth();
        
        \System\View::make('admin/new.php');
    }
    
    public function postNew() {
        $user = \System\Auth::getUser();
        
        $params = array(
            ':title' => filter_var($_POST['title'], FILTER_SANITIZE_STRING),
            ':content' => filter_var($_POST['content'], FILTER_SANITIZE_STRING),
            ':user_id' => filter_var($user->id, FILTER_SANITIZE_STRING),
            ':created' => strftime('%Y-%m-%d %H:%M:%S', time())
        );
        
        // beillesztes adatbazisba
        \System\Database::query(
                'INSERT INTO posts (title, content, user_id, created) VALUES (:title,:content,:user_id, :created)',
                $params
        );
        
        // atiranyitas a fooldalra
        header('Location: ' . \System\Request::getBaseURL());
        
    }
    
    public function getLogin() {
        \System\View::make('admin/login.php');
    }
    
    public function postLogin() {
        $name = filter_var($_POST['name']);
        $pass = filter_var($_POST['password']);
        
        \System\Auth::login($name, $pass);
        
        header('Location: ' . \System\Request::getBaseURL() . 'admin');
    }
    
    
    public function getLogout() {
        // felhasznalo kileptetese
        \System\Auth::logout();
        
        // atoiranyitas az admin oldalra (vissza)
        header('Location: ' . \System\Request::getBaseURL() . 'admin');
    }
    
}