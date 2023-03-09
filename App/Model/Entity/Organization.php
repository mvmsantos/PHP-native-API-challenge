<?php

    namespace App\Model\Entity;

    class Organization{


        /**
         * ID do Varejo
         * @var integer
         */
        public $id = 1;

        /**
         * Nome do Varejo
         * @var string
         */
        public $name = 'Varejo Teste';

        /**
         * Site do Varejo
         * @var string
         */
        public $site = 'https://github.com/mvmsantos/php-native-api-challenge';

        /**
         * Descrição ou sobre do Varejo
         * @var string
         */
        public $description = 'Esta é somente uma descrição do Varejo criado, é estatico ainda não provem do banco de dados';

        /**
         * Valor do Varejo
         * @var integer
         */
        public $sellValue = 80000;

        /**
         * Estoque do varejo
         * @var integer
         */
        public $productStock = 60;

        /**
         * Imagem dos produtos do varejo
         * @var string
         */
        public $productImage = 'Teste Imagem';
    }

?>