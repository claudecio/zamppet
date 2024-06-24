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
    }