<?php 
    class AuthController extends Controller {
        private $authModel;

        public function __construct() {
            $this ->  authModel = $this -> model("AuthModel");
        }

        public function index() {}

        public function login() {
            if(isset($_POST['logar'])) {
                $dados_login = [
                    'email' => $_POST['email'],
                    'senha'=> $_POST['senha'],
                ];

                $this -> authModel -> login($dados_login);
            } else {
                $dados_login = [
                    'email' => '',
                    'senha'=> '',
                ];
            }
            $this -> view("sistema/login/login", [
                'dados_login' => $dados_login
            ]);
        }

        public function logout() {
            unset($_SESSION['informacoes_usuario']);
            Helper::redirecionarUsuario('auth/login');
        }
    }