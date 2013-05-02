<?php

namespace Controller;

use System\Request as Request;
use System\View as View;

class Post extends \System\Controller {
    
    public function getFull() {
        
        // Post azonositoja
        $param = array(':id' => Request::getSegment(2));
        
        // Post adatai
        $lekerd = \System\Database::query('SELECT * FROM posts WHERE id = :id', $param);
        $this->data['post'] =  $lekerd->fetch(\PDO::FETCH_OBJ);
        
        //var_dump($this->data); die();
        
        // Posthoz tartozo kommentek
        $lekerdComments = \System\Database::query(
                'SELECT * FROM comments WHERE post_id = :id',   // lekerdezes
                $param                                          // parameter a post azonositoja
        );
        
        $comments = array();

        while ($elem = $lekerdComments->fetch(\PDO::FETCH_OBJ)) {
            $comments[] = $elem;
        }

        $this->data['comments'] = $comments;        
        
        // view kivalasztasa, adatok atadasa
        View::make('post/full.php', $this->data);
        
    }
    
    public function postFull() {
        
        // parameterek
        $param = array(
            ':post_id' => Request::getSegment(2),
            ':comment' => filter_var($_POST['comment'], FILTER_SANITIZE_STRING),
            ':email' => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)
        );
        
        // komment hozzaadasa
        $lekerd = \System\Database::query(
                'INSERT INTO comments (email, comment, post_id) VALUES (:email,:comment,:post_id)',
                $param
        );
        
        // atiranyitas vissza (frssites)
        header('Location: ' . Request::getBaseURL() . 'post/full/' . Request::getSegment(2));
    }
    
}