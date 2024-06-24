<?php
    class AuthModel {
        private $db;

        public function __construct() {
            $this -> db = new Connection();
        }

        public function login(array $dados_login) {
            if(empty($dados_login['email']) || empty($dados_login['senha'])) {
                Helper::gerarNotificacao("warning", "Algo deu errado com a solicitação!");
            }

            try {
                $this -> db -> query("SELECT * FROM funcionarios_usuarios WHERE deleted_at IS NULL");
                $resultado =  $this -> db -> fetchSingleResult();
                if($resultado && password_verify($dados_login["senha"], $resultado["senha"])) {
                    $_SESSION['informacoes_usuario'] = [
                        'id' => $resultado['id'],
                        'email' => $resultado['email'],
                        'funcionarios_id'=> $resultado['funcionarios_id']
                    ];
                    Helper::redirecionarUsuario("home");
                } else {
                    Helper::gerarNotificacao("warning","E-mail ou Senha Incorretos!");
                }
            } catch (Exception $e) {
                Helper::gerarNotificacao("danger","Ocorreu um erro durante a execução da solicitação!");
            }
        }
    }