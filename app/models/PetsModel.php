<?php
    class PetsModel {
        private $db;

        public function __construct() {
            $this -> db = new Connection();
        }

        public function cadastrarPet(array $dados_pet) {
            try {
                $this -> db -> query("INSERT INTO pets(clientes_id, nome, especie, raca, sexo, dataNascimento) VALUES (:clientes_id, :nome, :especie, :raca, :sexo, :dataNascimento)");
                $this -> db -> bind(":clientes_id", $dados_pet["clientes_id"]);
                $this -> db -> bind(":nome", $dados_pet["nome"]);
                $this -> db -> bind(":especie", $dados_pet["especie"]);
                $this -> db -> bind(":raca", $dados_pet["raca"]);
                $this -> db -> bind(":sexo", $dados_pet["sexo"]);
                $this -> db -> bind(":dataNascimento", empty($dados_pet["dataNascimento"]) ? NULL : $dados_pet["dataNascimento"]);
                $this -> db -> executeQuery();
                $idPet = $this -> db -> getLastInsertId();
                $this -> db -> query("INSERT INTO prontuarios(pets_id) VALUES (:pets_id)");
                $this -> db -> bind(":pets_id", $idPet);
                $this -> db -> executeQuery();

                Helper::gerarNotificacao("success", "Pet cadastrado com sucesso!");
                Helper::redirecionarUsuario("clientes/detalhar/".$dados_pet['clientes_id']);
            } catch (Exception $e) {
                Helper::gerarNotificacao("danger","Ocorreu um erro durante a execução da solicitação!");
            }
        }

        public function listarPetsCliente(int $clientes_id) {
            try {
                $this -> db -> query("SELECT * FROM pets WHERE clientes_id = :clientes_id");
                $this -> db -> bind(":clientes_id", $clientes_id);
                return $this -> db -> fetchAllResults();
            } catch (Exception $e) {
                Helper::gerarNotificacao("danger","Ocorreu um erro durante a execução da solicitação!");
            }
        }

        public function listarDadosPet(int $id) {
            try {
                $this -> db -> query("SELECT * FROM pets WHERE id = :id");
                $this -> db -> bind(":id", $id);
                $dados_pet = $this -> db -> fetchSingleResult();
                $this -> db -> query("SELECT * FROM prontuarios WHERE pets_id = :pets_id");
                $this -> db -> bind(":pets_id", $id);
                $idProntuario = $this -> db -> fetchSingleResult()['id'];
                $this -> db -> query("SELECT * FROM prontuarios_registros WHERE prontuarios_id = :prontuarios_id AND deleted_at IS NULL ORDER BY data_registro DESC");
                $this -> db -> bind(":prontuarios_id", $idProntuario);
                $registrosProntuario = $this -> db -> fetchAllResults();

                return [
                    'dados_pet' => $dados_pet,
                    'idProntuario' => $idProntuario,
                    'registrosProntuario' => $registrosProntuario
                ];
            } catch (Exception $e) {
                Helper::gerarNotificacao("danger","Ocorreu um erro durante a execução da solicitação!");
            }
        }

        public function registroProntuario(array $dados_registro) {
            try {
                $this -> db -> query("INSERT INTO prontuarios_registros (prontuarios_id, funcionarios_id, data_registro, observacao) VALUES (:prontuarios_id, :funcionarios_id, :data_registro, :observacao)");
                $this -> db -> bind(":prontuarios_id", $dados_registro['prontuarios_id']);
                $this -> db -> bind(":funcionarios_id", $dados_registro['funcionarios_id']);
                $this -> db -> bind(":data_registro", $dados_registro['data_registro']);
                $this -> db -> bind(":observacao", $dados_registro['observacao']);
                $this -> db -> executeQuery();
                Helper::gerarNotificacao("success", "Registro salvo com sucesso!");
                header("Refresh: 0");
            } catch (Exception $e) {
                Helper::gerarNotificacao("danger","Ocorreu um erro durante a execução da solicitação! $e");
            }
        }

        public function editarPet(array $dados_pet) {
            try {
                $this -> db -> query("UPDATE pets SET nome = :nome, especie = :especie, raca = :raca, sexo = :sexo, dataNascimento = :dataNascimento, updated_at = CURRENT_TIMESTAMP WHERE id = :id");
                $this -> db -> bind(":id", $dados_pet["id"]);
                $this -> db -> bind(":nome", $dados_pet["nome"]);
                $this -> db -> bind(":especie", $dados_pet["especie"]);
                $this -> db -> bind(":raca", $dados_pet["raca"]);
                $this -> db -> bind(":sexo", $dados_pet["sexo"]);
                $this -> db -> bind(":dataNascimento", empty($dados_pet["dataNascimento"]) ? NULL : $dados_pet["dataNascimento"]);
                $this -> db -> executeQuery();

                Helper::gerarNotificacao("success", "Pet atualizado com sucesso!");
                Helper::redirecionarUsuario("pets/detalhar/".$dados_pet['clientes_id']);
            } catch (Exception $e) {
                Helper::gerarNotificacao("danger","Ocorreu um erro durante a execução da solicitação!");
            }
        }
    }