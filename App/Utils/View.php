<?php

    namespace App\Utils;

    class View {

        /**
         * Variaveis padrões da View
         * @var array
         */
        private static $vars = [];

        /**
         * Metodo responsavel por definir os dados iniciais da classe
         * @param array $vars
         */
        public static function init($vars = []){
            self::$vars = $vars;

        }

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
         * @param array $vars (string/numeric)
         * @return string
         */
        public static function render($view, $vars = []){
            //CONTEUDO DA VIEW
            $contentView = self::getContentView($view);

            //MERGE DE VARIAVEIS DA VIEW
            $vars = array_merge(self::$vars, $vars);

            //CHAVES DO ARRAY DE VARIAVEIS
            $keys = array_keys($vars);
            $keys = array_map(function($item){
                return '{{'.$item.'}}';
            },$keys);

            //RETORNA CONTEUDO RENDERIZADO DA VIEW
            return str_replace($keys,array_values($vars),$contentView);

        }
    }

?>