<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Home{

    /**
     * Metodo responsavel por retornar o View da nossa home
     * @return string
     */
    public static function getHome(){
        return View::render('pages/home');

    }

}

?>