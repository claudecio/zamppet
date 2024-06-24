<?php
    class ClientesController extends Controller {

        private $clientesModel;
        private $petsModel;

        public function __construct() {
            $this -> clientesModel = $this -> model("ClientesModel");
            $this -> petsModel = $this -> model("PetsModel");
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
            $this -> view("sistema/clientes/inicio", [
                'search_parameters' => $search_parameters,
                'listaClientes' => $this -> clientesModel -> listarClientes($search_parameters)
            ]);
        }

        public function cadastrar() {
            if(isset($_POST['cadastrar_cliente'])) {
                if(empty($_POST['nome']) || empty($_POST['endereco']) || empty($_POST['cpf']) || empty($_POST['bairro']) || empty($_POST['cidade']) || empty($_POST['telefone'])) {
                    Helper::gerarNotificacao("warning", "Os campos com * são obrigatórios!");
                }

                $dados_clientes = [
                    'nome' => strtoupper($_POST['nome']),
                    'cpf' => $_POST['cpf'],
                    'endereco' => strtoupper($_POST['endereco']),
                    'bairro' => strtoupper($_POST['bairro']),
                    'cidade' => strtoupper($_POST['cidade']),
                    'telefone' => $_POST['telefone'] 
                ];

                $this -> clientesModel -> cadastrarCliente($dados_clientes);
            } else {
                $dados_clientes = [
                    'nome' => '',
                    'cpf' => '',
                    'endereco' => '',
                    'bairro' => '',
                    'cidade' => '',
                    'telefone' => '' 
                ];
            }
            $this -> view("sistema/clientes/cadastro", [
                'dados_cliente' => $dados_clientes
            ]);
        }

        public function detalhar(int $id = null) {
            if(empty($id) || $id == null) {
                Helper::gerarNotificacao("warning", "Cliente não encontrado!");
                Helper::redirecionarUsuario("clientes");
            }

            $dadosCliente = $this -> clientesModel -> consultarDadosCliente($id);

            if(isset($_POST['cadastrar_pet'])) {
                $dados_pet = [
                    'nome' => strtoupper($_POST['nome']),
                    'clientes_id' => $id,
                    'especie' => strtoupper($_POST['especie']),
                    'raca' => strtoupper($_POST['raca']),
                    'sexo' => strtoupper($_POST['sexo']),
                    'dataNascimento' => empty($_POST['dataNascimento']) ? '' : $_POST['dataNascimento']
                ];

                $this -> petsModel -> cadastrarPet($dados_pet);
            } else {
                $dados_pet = [
                    'nome' => '',
                    'especie' => '',
                    'raca' => '',
                    'sexo' => '',
                    'dataNascimento' => ''
                ];
            }

            $this -> view("sistema/clientes/detalhar", [
                'dados_cliente' => $dadosCliente,
                'dados_pet' => $dados_pet,
                'listarPets' => $this -> petsModel -> listarPetsCliente($id)
            ]);
        }

        public function editar(int $id = null) {
            if(empty($id) || $id == null) {
                Helper::gerarNotificacao("warning", "Cliente não encontrado!");
                Helper::redirecionarUsuario("clientes");
            }

            $dadosCliente = $this -> clientesModel -> consultarDadosCliente($id);

            if(isset($_POST['atualizar_dados'])) {
                if(empty($_POST['nome']) || empty($_POST['endereco']) || empty($_POST['bairro']) || empty($_POST['cidade']) || empty($_POST['telefone'])) {
                    Helper::gerarNotificacao("warning", "Os campos com * são obrigatórios!");
                }

                $dados_clientes = [
                    'id' => $id,
                    'nome' => strtoupper($_POST['nome']),
                    'cpf' => $_POST['cpf'],
                    'endereco' => strtoupper($_POST['endereco']),
                    'bairro' => strtoupper($_POST['bairro']),
                    'cidade' => strtoupper($_POST['cidade']),
                    'telefone' => $_POST['telefone'] 
                ];

                $this -> clientesModel -> editarCliente($dados_clientes);
            } else {
                $dados_clientes = [
                    'id' => $id,
                    'nome' => $dadosCliente['nome'],
                    'cpf' => $dadosCliente['cpf'],
                    'endereco' => $dadosCliente['endereco'],
                    'bairro' => $dadosCliente['bairro'],
                    'cidade' => $dadosCliente['cidade'],
                    'telefone' => $dadosCliente['telefone'] 
                ];
            }

            $this -> view("sistema/clientes/editar", [
                'dados_cliente' => $dados_clientes
            ]);
        }
    }