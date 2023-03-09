<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;

class Home extends Page {

    /**
     * Metodo responsavel por retornar o View da nossa home
     * @return string
     */
    public static function getHome(){

        //INSTANCIA DA ORGANIZAÇÃO
        $obOrganization = new Organization;
        
        //VIEW DA HOME
        $content = View::render('pages/Home',[
            'id' => $obOrganization->id,
            'name' => $obOrganization->name,
            'description' => $obOrganization->description,
            'sellValue' => $obOrganization->sellValue,
            'productStock' => $obOrganization->productStock,
            'productImage' => $obOrganization->productImage,
        ]);

        //RETORNA A VIEW DA PAGINA
        return parent::getPage('Teste Bootstrap', $content);
    }

}

?>