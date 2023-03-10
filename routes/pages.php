<?php

    use \App\Http\Response;
    use \App\Controller\Pages;

        //ROTA HOME
        $obRouter->get('/', [
            function(){
                return new Response(200, Pages\Home::getHome());
            }
        ]);
    
        //ROTA TELA2
        $obRouter->get('/tela2', [
            function(){
                return new Response(200, Pages\Tela2::getHome());
            }
        ]);
    
        //ROTA TELA3
        $obRouter->get('/tela3', [
            function(){
                return new Response(200, Pages\Home::getHome());
            }
        ]);
    
        //ROTA TELA4
        $obRouter->get('/tela4', [
            function(){
                return new Response(200, Pages\Home::getHome());
            }
        ]);
    
        //ROTA TELA5
        $obRouter->get('/tela5', [
            function(){
                return new Response(200, Pages\Home::getHome());
            }
        ]);
    
        //ROTA TELA6
        $obRouter->get('/tela6', [
            function(){
                return new Response(200, Pages\Home::getHome());
            }
        ]);
    
        //ROTA TELA7
        $obRouter->get('/tela7', [
            function(){
                return new Response(200, Pages\Home::getHome());
            }
        ]);
    
        //ROTA TELA8
        $obRouter->get('/tela8', [
            function(){
                return new Response(200, Pages\Home::getHome());
            }
        ]);



?>