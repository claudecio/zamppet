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
            print_r ($dadosPet);
        }
    }