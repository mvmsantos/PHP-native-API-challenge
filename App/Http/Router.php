<?php

    namespace App\Http;

    use \Closure;
    use \Exception;

    class Router {

        /**
         * URL completa do projeto (raiz)
         * @var string
         */
        private $url = '';

        /**
         * Prefixo de todas as rotas
         * @var string
         */
        private $prefix = '';

        /**
         * Indice de rotas
         * @var array
         */
        private $routes = [];

        /**
         * Instancia de Request
         * @var Request
         */
        private $request;

        /**
         * Método responsavel por iniciar a classe
         * @var string $url
         */
        public function __construct($url){

            $this->request = new Request();
            $this->url = $url;
            $this->setPrefix();
        }

        /**
         * Metodo responsavel por definir os prefixos das rotas
         */
        private function setPrefix(){
            //INFORMAÇÕES DA URL ATUAL
            $parseURL = parse_url($this->url);

            //DEFINE O PREFIXO
            $this->prefix = $parseURL['path'] ?? '';

        }

        /**
         * Método responsavel por adicionar uma rota na classe
         * @param string $method
         * @param string $route
         * @param array $params
         */
        private function addRoute($method, $route, $params = []){

            //VALIDAÇÃO DOS PARAMETROS
            foreach($params as $key=>$value){

                if($value instanceof Closure){
                    $params['controller'] = $value;
                    unset($params[$key]);
                    continue;
                }
            }

            //PADRÃO DE VALIDAÇÃO DA URL
            $patternRoute = '/^'.str_replace('/','\/',$route).'$/';

            //ADICIONA A ROTA DENTRO DA CLASSE
            $this->routes[$patternRoute][$method] = $params;
 
        }

        /**
         * Método responsavel por definir uma rota de GET
         * @param string $route
         * @param array $params
         */
        public function get($route,$params = []){

            return $this->addRoute('GET', $route, $params);
        }

        /**
         * Método responsavel por definir uma rota de POST
         * @param string $route
         * @param array $params
         */
        public function post($route,$params = []){

            return $this->addRoute('POST', $route, $params);
        }

        /**
         * Método responsavel por definir uma rota de PUT
         * @param string $route
         * @param array $params
         */
        public function put($route,$params = []){

            return $this->addRoute('PUT', $route, $params);
        }

        /**
         * Método responsavel por definir uma rota de DELETE
         * @param string $route
         * @param array $params
         */
        public function delete($route,$params = []){

            return $this->addRoute('DELETE', $route, $params);
        }

        /**
         * Método responsavel por retornar a URI desconsiderando o prefixo
         * @return string
         */
        private function getUri(){
            //URI DA REQUEST
            $uri =  $this->request->getUri();
            
            //FATIA A URI COM O PREFIXO
            $xUri = strlen($this->prefix) ? explode($this->prefix,$uri) : [$uri];
    
            //RETORNA A URI SEM PREFIXO
            return end($xUri);
        }

        /**
         * Método responsavel por retornar os dados da rota atual
         * @return array
         */
        private function getRoute(){
            //URI 
            $uri =  $this->getUri();

            //METHOD
            $httpMethod = $this->request->getHttpMethod();

            //VALIDA AS ROTAS   
            foreach ($this->routes as $patternRoute=>$methods) {
                //VERIFICA SE A URI BATE O PADRÃO
                if(preg_match($patternRoute,$uri)){
                    //VERIFICA O METODO
                    if(isset($methods[$httpMethod])){

                        //RETORNO DOS PARAMETROS DA ROTA
                        return $methods[$httpMethod];
                    }
                    //MÉTODO NÃO PERMITIDO/DEFINIDO
                    throw new Exception("Método não permitido",405);
                }
            }

            //URL NÃO ENCONTRADA
            throw new Exception("URL não encontrada",404);
        }

        /**
         * Método responsavel por executar a rota atual
         * @return Response
         */
        public function run(){
            try {
                
                //OBTEM A ROTA ATUAL
                $route = $this->getRoute();

                //VERIFICA O CONTROLLADOR
                if(!isset($route['controller'])){
                    throw new Exception("URL não pode ser processada", 500);
                }

                //ARGUMENTOS DA FUNÇÃO
                $args = [];

                //RETORNA A EXECUÇÃO DA FUNÇÃO
                return call_user_func_array($route['controller'],$args);

            } catch (Exception $e) {
                return new Response($e->getCode(),$e->getMessage());
            }
        }        

    }

?>