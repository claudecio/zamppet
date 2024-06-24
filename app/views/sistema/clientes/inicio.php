<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="auto">
    <head>
        <meta charset="UTF-8">
        <meta name="theme-color" content="#712cf9">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Clientes</title>
        <link href="<?=URL?>/public/css/bootstrap.min.css" rel="stylesheet">
        <script src="<?=URL?>/public/js/color-modes.js"></script>
        <script src="<?=URL?>/public/js/jquery/jquery-3.7.1.min.js"></script>
        <script src="<?=URL?>/public/js/jquery/jquery.mask.min.js"></script>
        <script src="<?=URL?>/public/js/block_enter.js"></script>
        <script src="<?=URL?>/public/js/bootstrap.bundle.min.js"></script>
        <style>
            table {
            width: 100%;
            border-collapse: collapse;
            }
            th, td {
            padding: 8px;
            text-align: left;
            }
            /* Defina uma altura máxima para a tabela */
            .table-wrapper
            {
                max-height: 600px; /* Defina a altura máxima desejada */
                overflow-x: auto; /* Adiciona barra de rolagem horizontal */
                overflow-y: auto; /* Adiciona barra de rolagem vertical */
            }
            .cabecalho
            {
                text-align: center
            }
            td.centralizado
            {
                text-align: center;     /* alinhamento horizontal */
                vertical-align: middle; /* alinhamento vertical */
            }
            a{
                text-decoration: none;
            }
            .clickable-row {
                cursor: pointer;
            }
            .clickable-row:hover {
                background-color: #f5f5f5;
            }
	    </style>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const rows = document.querySelectorAll('.clickable-row');
                rows.forEach(row => {
                    row.addEventListener('click', function() {
                        window.location.href = this.getAttribute('data-href');
                    });
                });
            });
        </script>
    </head>
    <body>
        <!-- HEADER -->
        <?php include_once '../app/views/sistema/header.php'; ?>
        <?php $search_parameters = $dados['search_parameters']; ?>
        <!-- Conteúdo -->
        <div class="container">
            <h2 class="pb-2 border-bottom">Clientes</h2>
            <form class="row g-3" action="<?=URL?>/clientes" method="POST">
                <div class="col-md-10">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <svg width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                            </svg>
                        </span>
                        <input type="text" class="form-control" placeholder="Pesquise aqui *" name="consulta" style="text-transform: UPPERCASE;" value="<?=$search_parameters['consulta']?>" maxlength="50">
                    </div>
                </div>
                <div class="col-md-1">
                    <button type="submit" name="pesquisar" class="btn btn-secondary">
                        Consulta
                    </button>
                </div>
                <div class="col-md-1">
                    <a href="<?=URL?>/clientes/cadastrar" class="btn btn-success">Cadastrar</a>
                </div>
                <div class="table-wrapper">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th scope="col" class="cabecalho">Nome</th>
                            <th scope="col" class="cabecalho">CPF</th>
                            <th scope="col" class="cabecalho">Telefone</th>
                            <th scope="col" class="cabecalho">Cidade</th>
                        </tr>
                        <?php
                            if (!empty($dados['listaClientes']))
                            {
                                $resultados = 0;
                                //Mostra os funcionarios registrados no sistema
                                foreach ($dados['listaClientes'] as $cliente)
                                {
                                    // Verifica se o campo deleted_at é nulo
                                    if(is_null($cliente['deleted_at'])) {
                                        print "<tr class='clickable-row' data-href="."'".URL."/clientes/detalhar/".$cliente['id']."'>";
                                        print "<td class='centralizado'>".$cliente['nome']."</td>";
                                        print "<td class='centralizado'>".$cliente['cpf']."</td>";
                                        print "<td class='centralizado'>".$cliente['telefone']."</td>";
                                        print "<td class='centralizado'>".$cliente['cidade']."</td>";
                                        print "</tr>";
                                        $resultados++;
                                    }

                                    if($resultados == 0) {
                                        print "<tr>";
                                        print "<td class='centralizado' colspan='5'>A PESQUISA NÃO RETORNOU NENHUM RESULTADO!</td>";
                                        print "</tr>";
                                    }
                                }
                            }
                            else
                            {
                                print "<tr>";
                                print "<td class='centralizado' colspan='5'>A PESQUISA NÃO RETORNOU NENHUM RESULTADO!</td>";
                                print "</tr>";
                            }
                            
                        ?>
                    </table>
                </div>
                <!-- BOTÃO DE VOLTAR PARA A PÁGINA ANTERIOR -->
                <div class="col-md-12">
                    <a href="<?=URL?>/home" class="btn btn-secondary">Voltar</a>
                </div>
            </form>
            <div class="container py-4">
                <footer class="pt-3 mt-4 text-body-secondary border-top">
                    Copyright  &copy;<?php echo date("Y");?> Zamp Pet.
                </footer>
            </div>
        </div>
    </body>
</html>