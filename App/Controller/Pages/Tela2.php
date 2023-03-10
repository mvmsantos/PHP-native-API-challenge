<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;

class Tela2 extends Page {

    /**
     * Metodo responsavel por retornar o View da nossa home
     * @return string
     */
    public static function getHome(){

        //INSTANCIA DA ORGANIZAÇÃO
        $obOrganization = new Organization;
        
        //VIEW DA HOME
        $content = View::render('pages/tela2',[
            'id' => $obOrganization->id,
            'description' => $obOrganization->description,
            'sellValue' => $obOrganization->sellValue,
            'productStock' => $obOrganization->productStock,
            'productImage' => $obOrganization->productImage,
        ]);

        //RETORNA A VIEW DA PAGINA
        return parent::getPage('Tela 2', $content);
    }

}

?>