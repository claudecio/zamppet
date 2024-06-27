<?php
    class PetsController extends Controller {

        private $petsModel;

        public function __construct() {
            $this -> petsModel = $this -> model("petsModel");
        }

        public function detalhar($id = null) {
            if(empty($id) || $id == null) {
                Helper::gerarNotificacao("warning", "Pet não encontrado!");
                Helper::redirecionarUsuario("pets");
            }

            $dadosPet = $this -> petsModel -> listarDadosPet($id);
            
            if(isset($_POST['salvar_registro'])) {
                $dados_registro = [
                    'prontuarios_id' => $_POST['prontuarios_id'],
                    'funcionarios_id' => $_SESSION['informacoes_usuario']['funcionarios_id'],
                    'data_registro' => $_POST['data_registro'],
                    'observacao' => strtoupper($_POST['observacao']),
                ];

                $this -> petsModel -> registroProntuario($dados_registro);
            }

            $this -> view("sistema/pets/detalhar", [
                'dados_pet' => $dadosPet
            ]);
        }

        public function editar($id = null) {
            if(empty($id) || $id == null) {
                Helper::gerarNotificacao("warning", "Pet não encontrado!");
                Helper::redirecionarUsuario("pets");
            }
            $dadosPet = $this -> petsModel -> listarDadosPet($id);

            if(isset($_POST['atualizar_dados'])) {
                $dados_pet = [
                    'id' => $id,
                    'nome' => strtoupper($_POST['nome']),
                    'clientes_id' => $id,
                    'especie' => strtoupper($_POST['especie']),
                    'raca' => strtoupper($_POST['raca']),
                    'sexo' => strtoupper($_POST['sexo']),
                    'dataNascimento' => empty($_POST['dataNascimento']) ? '' : $_POST['dataNascimento']
                ];

                $this -> petsModel -> editarPet($dados_pet);
            } else {
                $dados_pet = [
                    'id' => $dadosPet['dados_pet']['id'],
                    'nome' => $dadosPet['dados_pet']['nome'],
                    'especie' => $dadosPet['dados_pet']['especie'],
                    'raca' => $dadosPet['dados_pet']['raca'],
                    'sexo' => $dadosPet['dados_pet']['sexo'],
                    'dataNascimento' => $dadosPet['dados_pet']['dataNascimento']
                ];
            }

            $this -> view("sistema/pets/editar", [
                'dados_pet' => $dados_pet
            ]);
        }
    }