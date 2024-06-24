<?php
    /**
    * Classe Router
    * 
    * Responsável por rotear as requisições para os controladores correspondentes com base na URL.
    */
    class Router
    {
        // Propriedades
        private $controller = 'HomeController'; // Controlador padrão
        private $method = 'index'; // Método padrão
        private $parameters = []; // Parâmetros da URL

        /**
        * Construtor da classe Router.
        * 
        * Inicializa a classe, define o idioma padrão do sistema e roteia a requisição para o controlador e método correspondentes.
        */
        public function __construct() {
            // Obtém a URL da requisição ou define uma URL padrão
            $url = $this -> url() ? $this -> url() : [0];

            // Verifica se há algo na URL e se há um controlador correspondente
            if ($url[0] !== 0) {
                // Verifica se existe um arquivo de controlador correspondente ao nome passado na URL
                if (file_exists('../app/controllers/'.ucwords($url[0]).'Controller.php')) {
                    // Define o nome do controlador a ser utilizado
                    $this -> controller = ucwords($url[0]).'Controller';
                    // Remove o nome do controlador do array $url
                    array_shift($url);
                } else {
                    // Se o arquivo do controlador não existir, define um controlador de erro
                    $this -> controller = 'ErroController';
                }
            }

            // Inclui o arquivo do controlador
            require_once '../app/controllers/'.$this -> controller.'.php';
            // Instancia o objeto do controlador
            $this -> controller = new $this -> controller;

            // Verifica se há um método especificado na URL
            if (isset($url[0])) {
                // Verifica se o método especificado existe no controlador
                if (method_exists($this -> controller, $url[0])) {
                    // Define o método a ser chamado
                    $this -> method = $url[0];
                    // Remove o nome do método do array $url
                    array_shift($url);
                }
            }

            // Define os parâmetros a serem passados para o método
            $this -> parameters = $url ? array_values($url) : [];
            if (count($this -> parameters) == 0) {
                $this -> parameters[] = NULL;
            }

            // Chama o método no controlador, passando os parâmetros
            call_user_func_array([$this -> controller, $this -> method], $this -> parameters);
        }

        /**
        * Obtém a URL da requisição.
        * 
        * @return array|null Retorna um array com os componentes da URL ou NULL se a URL não estiver definida.
        */
        private function url() {
            // Obtém a parte da query string chamada 'url' da requisição
            $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
            // Verifica se a URL foi definida
            if (isset($url)) {
                // Remove espaços em branco no início e no final da URL
                // Remove a barra final, caso exista, para garantir uma URL consistente
                $url = trim(rtrim($url), '/');
                // Divide a URL em um array, usando a barra como delimitador
                return ($url == 'index.php') ? NULL : explode('/', $url);
            }
        }
    }