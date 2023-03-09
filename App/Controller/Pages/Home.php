<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Home extends Page {

    /**
     * Metodo responsavel por retornar o View da nossa home
     * @return string
     */
    public static function getHome(){
        
        //VIEW DA HOME
        $content = View::render('pages/Home',[
            'id' => 'testeID',
            'description' => 'testeDescrição',
            'sellValue' => 'testeValorVenda',
            'productStock' => 'testeEstoque',
            'productImage' => 'testeImagens',
        ]);

        //RETORNA A VIEW DA PAGINA
        return parent::getPage('Teste Bootstrap', $content);
    }

}

?>