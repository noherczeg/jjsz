<?php

namespace Controller;

use System\Database as Database;
use System\Session as Session;
use System\View as View;
use System\Request as Request;
use System\Cookie as Cookie;

class Home extends \System\Controller {
    
    public function getIndex() {
        View::make('home/welcome.php');
    }
    
    public function getDb() {
        $lekerd = Database::query('SELECT * FROM proba');
        
        while ($elem = $lekerd->fetch(\PDO::FETCH_OBJ)) {
            var_dump($elem);
        }
    }
    
    public function getForm() {
        $this->data['title'] = "Login form";
        $this->data['ido'] = strftime('%Y. %B %d. %H:%I:%S', Session::get('LAST_ACTIVITY'));
        
        View::make('home/login.php', $this->data);
    }
    
    public function postForm() {
        var_dump($_POST);
    }
    
    public function getModel() {
        $user = new \Model\User;
        $user->name = 'jozsi';
        $user->age = 10;
        
        var_dump($user);
    }
    
    public function getUrl() {
        echo Request::getBaseURL();
    }
    
    public function getCookie() {
        var_dump(Cookie::getAll());
        
        if (!Cookie::is_set('asd')) {
            Cookie::set('asd', 'teszt', time() + 3600);
        }
    }
    
}