<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Page{

    /**
     * Metodo responsavel por renderizar o topo da minha pagina
     * @return string
     */
    private static function getHeader(){
        return View::render('pages/header');
    }

    /**
     * Metodo responsavel por renderizar o rodapé da minha pagina
     * @return string
     */
    private static function getFooter(){
        return View::render('pages/footer');
    }

    /**
     * Metodo responsavel por retornar o View da nossa página genérica
     * @return string
     */
    public static function getPage($title, $content){
        return View::render('pages/page',[
            'title' => $title,
            'header' => self::getHeader(),
            'content' => $content,
            'footer' => self::getFooter()
        ]);
    }

}

?>