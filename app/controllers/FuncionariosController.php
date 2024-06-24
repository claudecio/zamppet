<?php
    class FuncionariosController extends Controller {
        private $funcionariosModel;

        public function __construct() {
            $this -> funcionariosModel = $this -> model("FuncionariosModel");
        }

        public function index() {
            if(isset($_POST["pesquisar"])) {
                $search_parameters =[
                    'consulta' => $_POST['consulta']
                ];
            } else {
                $search_parameters =[
                    'consulta' => ''
                ];
            }
            $this -> view("sistema/funcionarios/inicio", [
                'search_parameters' => $search_parameters,
                'listaFuncionarios' => $this -> funcionariosModel -> listarFuncionarios($search_parameters)
            ]);
        }

        public function cadastrar() {
            if(isset($_POST['cadastrar_funcionario'])) {
                if(empty($_POST['nome']) || empty($_POST['cpf']) || empty($_POST['cargo']) || empty($_POST['data_admissao'])) {
                    Helper::gerarNotificacao("warning", "Os campos com * são obrigatórios!");
                }

                list($funcionarios_cargos_id, $cargo) = explode('_', $_POST['funcionarios_cargos_id']);

                $dados_funcionario = [
                    'nome' => strtoupper($_POST['nome']),
                    'funcionarios_cargos_id' => $funcionarios_cargos_id, 
                    'cpf' => $_POST['cpf'],
                    'cargo' => strtoupper($cargo),
                    'data_admissao' => $_POST['data_admissao'],
                ];

                $this -> funcionariosModel -> cadastrarFuncionario($dados_funcionario);
            } else {
                $dados_funcionario = [
                    'nome' => '',
                    'funcionarios_cargos_id' => '',
                    'cpf' => '',
                    'cargo' => '',
                    'data_admissao' => '',
                ];
            }
            $this -> view("sistema/funcionarios/cadastro", [
                'dados_funcionario' => $dados_funcionario
            ]);
        }

        public function detalhar($id = null) {
            if(empty($id) || $id == null) {
                Helper::gerarNotificacao("warning", "Funcionário não encontrado!");
                Helper::redirecionarUsuario("funcionarios");
            }

            $dadosFuncionario = $this -> funcionariosModel -> consultarDadosFuncionario($id);

            $this -> view("sistema/funcionarios/detalhar", [
                'dados_funcionario' => $dadosFuncionario,
            ]);
        }

        public function editar($id = null) {
            if(empty($id) || $id == null) {
                Helper::gerarNotificacao("warning", "Funcionário não encontrado!");
                Helper::redirecionarUsuario("funcionarios");
            }

            $dadosFuncionario = $this -> funcionariosModel -> consultarDadosFuncionario($id);

            if(isset($_POST['atualizar_dados'])) {

                list($funcionarios_cargos_id, $cargo) = explode('_', $_POST['funcionarios_cargos_id']);

                $dados_funcionario = [
                    'id' => $id,
                    'nome' => strtoupper($_POST['nome']),
                    'funcionarios_cargos_id' => $funcionarios_cargos_id, 
                    'cpf' => $_POST['cpf'],
                    'cargo' => strtoupper($cargo),
                    'data_admissao' => $_POST['data_admissao'],
                ];

                $this -> funcionariosModel -> editarFuncionario($dados_funcionario);

            } else {
                $dados_funcionario = [
                    'id' => $id,
                    'nome' => $dadosFuncionario['nome'],
                    'funcionarios_cargos_id' => $dadosFuncionario['funcionarios_cargos_id'],
                    'cpf' => $dadosFuncionario['cpf'],
                    'cargo' => $dadosFuncionario['cargo'],
                    'data_admissao' => $dadosFuncionario['data_admissao'],
                ];
            }

            $this -> view("sistema/funcionarios/editar", [
                'dados_funcionario' => $dados_funcionario
            ]);
        }
    }