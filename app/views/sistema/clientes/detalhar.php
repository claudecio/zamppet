<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="theme-color" content="#712cf9">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Visualizar Cliente</title>
        <link href="<?=URL?>/public/css/bootstrap.min.css" rel="stylesheet">
        <script src="<?=URL?>/public/js/color-modes.js"></script>
        <script src="<?=URL?>/public/js/jquery/jquery-3.7.1.min.js"></script>
        <script src="<?=URL?>/public/js/jquery/jquery.mask.min.js"></script>
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
        <?php $dados_cliente  = $dados['dados_cliente']; ?>
        <!-- Conteúdo -->
        <div class="container">
            <h2 class="pb-2 border-bottom">Dados do Cliente</h2>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nome<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="nome" value="<?=$dados_cliente['nome']?>" style="text-transform: uppercase;" maxlength="50" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label">CPF<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="cpf" value="<?=$dados_cliente['cpf']?>" style="text-transform: uppercase;" maxlength="11" disabled>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Endereço<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="endereco" value="<?=$dados_cliente['endereco']?>" style="text-transform: uppercase;" maxlength="50" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Bairro<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="bairro" value="<?=$dados_cliente['bairro']?>" style="text-transform: uppercase;" maxlength="50" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Cidade<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="cidade" value="<?=$dados_cliente['cidade']?>" style="text-transform: uppercase;" maxlength="50" disabled>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Telefone<sup class="text-danger">*</sup></label>
                    <input type="number" class="form-control" name="telefone" value="<?=$dados_cliente['telefone']?>" maxlength="11" disabled>
                </div>
                <div class="col-md-12">
                    <a href="<?=URL?>/clientes" class="btn btn-secondary">Voltar</a>
                    <a href="<?=URL?>/clientes/editar/<?=$dados_cliente['id']?>" class="btn btn-warning">Editar Informações</a>
                </div>
            </div>
            <hr>
            <h5 class="pb-2 border-bottom">Pets Registrados</h5>
            <div class="table-wrapper">
                <table class="table table-striped">
                    <tr>
                        <th scope="col" class="cabecalho">Nome</th>
                        <th scope="col" class="cabecalho">Especie</th>
                        <th scope="col" class="cabecalho">Sexo</th>
                    </tr>
                    <?php
                        if (!empty($dados['listarPets']))
                        {
                            $resultados = 0;

                            //Mostra os funcionarios registrados no sistema
                            foreach ($dados['listarPets'] as $pet)
                            {
                                    // Verifica se o campo deleted_at é nulo e o produto não está excluido
                                if(is_null($pet['deleted_at'])) {

                                    print "<tr class='clickable-row' data-href="."'".URL."/pets/detalhar/".$pet['id']."'>";
                                    print '<td class="centralizado">'.$pet['nome']."</td>";
                                    print '<td class="centralizado">'.$pet['especie']."</td>";
                                    print '<td class="centralizado">'.$pet['sexo']."</td>";
                                    print "</tr>";

                                    $resultados++;
                                }
                            }

                            if($resultados == 0) {
                                print "<tr>";
                                print "<td class='centralizado' colspan='6'>NENHUM PET REGISTRADO PARA O CLIENTE!</td>";
                                print "</tr>";
                            }
                        }
                        else
                        {
                            print "<tr>";
                            print "<td class='centralizado' colspan='6'>NENHUM PET REGISTRADO PARA O CLIENTE!</td>";
                            print "</tr>";
                        }
                            
                    ?>
                </table>
                <div class="col-md-12">
                    <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#registrar_pet">Registrar Pet</button>
                </div>
            </div>
        </div>
        <div class="container py-4">
            <footer class="pt-3 mt-4 text-body-secondary border-top">
                Copyright  &copy;<?php echo date("Y");?> Zamp Pet.
            </footer>
        </div>

        <!-- MODAL CADASTRAR PET -->
        <form method="POST" action="<?=URL?>/clientes/detalhar/<?=$dados_cliente['id']?>">
            <div class="modal fade" id="registrar_pet" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de Pets</h1>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12">
                                <label class="form-label">Nome<sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" name="nome" value="<?=$dados['dados_pet']['nome']?>" style="text-transform: uppercase;" maxlength="50" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Especie<sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" name="especie" value="<?=$dados['dados_pet']['especie']?>" style="text-transform: uppercase;" maxlength="50" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Raça<sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" name="raca" value="<?=$dados['dados_pet']['raca']?>" style="text-transform: uppercase;" maxlength="50" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Sexo<sup class="text-danger">*</sup></label>
                                <select class="form-select" name="sexo" required>
                                    <option disabled selected></option>
                                    <option value="MACHO">MACHO</option>
                                    <option value="FÊMEA">FÊMEA</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Data Nascimento</label>
                                <input type="date" class="form-control" name="dataNascimento" value="<?=$dados['dados_pet']['dataNascimento']?>" style="text-transform: uppercase;" maxlength="50">
                            </div>
                        </div>
                        <div class="modal-footer justify-content-start">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button class="btn btn-success" type="submit" name="cadastrar_pet">Cadastrar Pet</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>