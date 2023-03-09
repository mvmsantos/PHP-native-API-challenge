<?php

    namespace App\Utils;

    class View {

        /**
         * Método responsavel por retornar o contéudo da view
         * @param string $view
         * @return string
         */        
        private static function getContentView($view){
            $file = __DIR__.'/../../resources/view/'.$view.'.html';
            return file_exists($file) ? file_get_contents($file) : '';
        }

        /**
         * Método responsavel por retornar o contéudo renderizado da view
         * @param string $view
         * @return string
         */
        public static function render($view){
            //CONTEUDO DA VIEW
            $contentView = self::getContentView($view);

            //RETORNA CONTEUDO RENDERIZADO DA VIEW
            return $contentView;

        }
    }

?>