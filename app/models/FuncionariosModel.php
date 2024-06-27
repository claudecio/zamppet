<?php
    class FuncionariosModel {
        private $db;

        public function __construct(){
            $this -> db = new Connection();
        }

        public function listarFuncionarios(array $search_parameters) {
            try {
                if(empty($search_parameters['consulta'])) {
                    $this -> db -> query("SELECT * FROM funcionarios");
                    return $this -> db -> fetchAllResults();
                } else {
                    $this -> db -> query("SELECT * FROM funcionarios WHERE nome LIKE :consulta");
                    $this -> db -> bind(":consulta", "%".$search_parameters["consulta"]."%");
                    return $this -> db -> fetchAllResults();
                }
            } catch (Exception $e) {
                Helper::gerarNotificacao("danger","Ocorreu um erro durante a execução da solicitação!");
            }
        }

        public function cadastrarFuncionario(array $dados_funcionario) {
            try {
                $this -> db -> query("INSERT INTO funcionarios(funcionarios_cargos_id, nome, cpf, cargo, data_admissao) VALUES (:funcionarios_cargos_id, :nome, :cpf, :cargo, :data_admissao)");
                $this -> db -> bind(":funcionarios_cargos_id", $dados_funcionario['funcionarios_cargos_id']);
                $this -> db -> bind(":nome", $dados_funcionario['nome']);
                $this -> db -> bind(":cpf", $dados_funcionario['cpf']);
                $this -> db -> bind(":cargo", $dados_funcionario['cargo']);
                $this -> db -> bind(":data_admissao", !empty($dados_funcionario['data_admissao']) ? $dados_funcionario['data_admissao'] : NULL);
                $this -> db -> executeQuery();
                $idFuncionario = $this -> db -> getLastInsertId();
                $this -> db -> query("INSERT INTO funcionarios_usuarios(funcionarios_id, email, senha) VALUES (:funcionarios_id, :email, :senha)");
                $this -> db -> bind(":funcionarios_id", $idFuncionario);
                $this -> db -> bind(":email", $dados_funcionario['email']);
                $this -> db -> bind(":senha", password_hash('12345678', PASSWORD_DEFAULT));
                $this -> db -> executeQuery();

                Helper::gerarNotificacao("success", "Funcionário cadastrado com sucesso!");
                Helper::redirecionarUsuario("funcionarios/detalhar/$idFuncionario");
            } catch (Exception $e) {
                Helper::gerarNotificacao("danger","Ocorreu um erro durante a execução da solicitação!");
            }
        }

        public function consultarDadosFuncionario(int $id){
            try {
                $this -> db -> query("SELECT * FROM funcionarios LEFT JOIN funcionarios_usuarios ON funcionarios.id = funcionarios_usuarios.funcionarios_id WHERE funcionarios.id = :id");
                $this -> db -> bind(":id", $id);
                $resultado = $this -> db -> fetchSingleResult();
                if($resultado) {
                    return $resultado;
                } else {
                    Helper::gerarNotificacao("warning", "Funcionário não encontrado!");
                    Helper::redirecionarUsuario("funcionarios");
                }
            } catch (Exception $e) {
                Helper::gerarNotificacao("danger","Ocorreu um erro durante a execução da solicitação!");
            }
        }

        public function editarFuncionario(array $dados_funcionario) {
            try {
                $this -> db -> query("UPDATE funcionarios SET funcionarios_cargos_id = :funcionarios_cargos_id, nome = :nome, cpf = :cpf, cargo = :cargo, data_admissao = :data_admissao, updated_at = CURRENT_TIMESTAMP WHERE id = :id");
                $this -> db -> bind(":id", $dados_funcionario['id']);
                $this -> db -> bind(":funcionarios_cargos_id", $dados_funcionario['funcionarios_cargos_id']);
                $this -> db -> bind(":nome", $dados_funcionario['nome']);
                $this -> db -> bind(":cpf", $dados_funcionario['cpf']);
                $this -> db -> bind(":cargo", $dados_funcionario['cargo']);
                $this -> db -> bind(":data_admissao", !empty($dados_funcionario['data_admissao']) ? $dados_funcionario['data_admissao'] : NULL);
                $this -> db -> executeQuery();
                $this -> db -> query("UPDATE funcionarios_usuarios SET email = :email, updated_at = CURRENT_TIMESTAMP WHERE funcionarios_id = :funcionarios_id");
                $this -> db -> bind(":email", $dados_funcionario['email']);
                $this -> db -> bind(":funcionarios_id", $dados_funcionario['id']);
                $this -> db -> executeQuery();

                Helper::gerarNotificacao("success", "Funcionário atualizado com sucesso!");
                Helper::redirecionarUsuario("funcionarios/detalhar/".$dados_funcionario['id']);
            } catch (Exception $e) {
                Helper::gerarNotificacao("danger","Ocorreu um erro durante a execução da solicitação! $e");
            }
        }
    }