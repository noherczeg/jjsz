<?php

namespace Controller;

class Home extends \System\Controller {

    public function getIndex() {
        /**
         * Postok listaja
         */
        $lekerd = \System\Database::query('SELECT * FROM posts');
        $lista = array();

        while ($elem = $lekerd->fetch(\PDO::FETCH_OBJ)) {
            $lista[] = $elem;
        }

        $this->data['posts'] = $lista;

        /**
         * view generalasa
         */
        \System\View::make('home/index.php', $this->data);
    }

}