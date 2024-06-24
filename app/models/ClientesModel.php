<?php
    class ClientesModel {

        private $db;

        public function __construct() {
            $this -> db = new Connection();
        }

        public function listarClientes(array $search_parameters) {
            try {
                if(empty($search_parameters['consulta'])) {
                    $this -> db -> query("SELECT * FROM clientes");
                    return $this -> db -> fetchAllResults();
                } else {
                    $this -> db -> query("SELECT * FROM clientes WHERE nome LIKE :consulta");
                    $this -> db -> bind(":consulta", "%".$search_parameters["consulta"]."%");
                    return $this -> db -> fetchAllResults();
                }
            } catch (Exception $e) {
                Helper::gerarNotificacao("danger","Ocorreu um erro durante a execução da solicitação!");
            }
        }

        public function cadastrarCliente(array $dados_cliente) {
            try {
                $this -> db -> query("INSERT INTO clientes(nome, cpf, endereco, bairro, cidade, telefone) VALUES (:nome, :cpf, :endereco, :bairro, :cidade, :telefone)");
                $this -> db -> bind(":nome", $dados_cliente["nome"]);
                $this -> db -> bind(":cpf", $dados_cliente["cpf"]);
                $this -> db -> bind(":endereco", $dados_cliente["endereco"]);
                $this -> db -> bind(":bairro", $dados_cliente["bairro"]);
                $this -> db -> bind(":cidade", $dados_cliente["cidade"]);
                $this -> db -> bind(":telefone", $dados_cliente["telefone"]);
                $this -> db -> executeQuery();
                $idCliente = $this -> db -> getLastInsertId();
                Helper::gerarNotificacao("success", "Cliente cadastrado com sucesso!");
                Helper::redirecionarUsuario("clientes/detalhar/$idCliente");
            } catch (Exception $e) {
                Helper::gerarNotificacao("danger","Ocorreu um erro durante a execução da solicitação!");
            }
        }

        public function editarCliente(array $dados_cliente) {
            try {
                $this -> db -> query("UPDATE clientes SET nome = :nome, cpf = :cpf, endereco = :endereco, bairro = :bairro, cidade = :cidade, telefone = :telefone, updated_at = CURRENT_TIMESTAMP WHERE id = :id");
                $this -> db -> bind(":id", $dados_cliente["id"]);
                $this -> db -> bind(":nome", $dados_cliente["nome"]);
                $this -> db -> bind(":cpf", $dados_cliente["cpf"]);
                $this -> db -> bind(":endereco", $dados_cliente["endereco"]);
                $this -> db -> bind(":bairro", $dados_cliente["bairro"]);
                $this -> db -> bind(":cidade", $dados_cliente["cidade"]);
                $this -> db -> bind(":telefone", $dados_cliente["telefone"]);
                $this -> db -> executeQuery();

                Helper::gerarNotificacao("success", "Cliente atualizado com sucesso!");
                Helper::redirecionarUsuario("clientes/detalhar/".$dados_cliente["id"]);
            } catch (Exception $e) {
                Helper::gerarNotificacao("danger","Ocorreu um erro durante a execução da solicitação!");
            }
        }

        public function consultarDadosCliente(int $id) {
            try {
                $this -> db -> query("SELECT * FROM clientes WHERE id = :id");
                $this -> db -> bind(":id", $id);
                $resultado = $this -> db -> fetchSingleResult();
                if($resultado) {
                    return $resultado;
                } else {
                    Helper::gerarNotificacao("warning", "Cliente não encontrado!");
                    Helper::redirecionarUsuario("clientes");
                }
            } catch (Exception $e) {
                Helper::gerarNotificacao("danger","Ocorreu um erro durante a execução da solicitação!");
            }
        }
    }