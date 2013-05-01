<?php

namespace Controller;

use System\Database as Database;
use System\Session as Session;
use System\View as View;
use System\Request as Request;
use System\Cookie as Cookie;

class Home extends \System\Controller {
    
    public function getIndex() {
        $this->data['user'] = Session::get('user');
        View::make('home/welcome.php', $this->data);
    }
    
    public function getLogin() {
        $this->data['title'] = "Login form";
        $this->data['ido'] = strftime('%Y. %B %d. %H:%I:%S', Session::get('LAST_ACTIVITY'));
        
        View::make('home/login.php', $this->data);
    }
    
    public function postLogin() {
        $name = filter_var($_POST['name']);
        $pass = md5(filter_var($_POST['password']));
        var_dump(\System\Auth::login($name, $pass));
    }
    
    public function getLogout() {
        \System\Auth::logout();
        header('Location: ' . \Request::getBaseURL());
    }
    
    public function getDb() {
        $lekerd = Database::query('SELECT * FROM proba');
        
        while ($elem = $lekerd->fetch(\PDO::FETCH_OBJ)) {
            var_dump($elem);
        }
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