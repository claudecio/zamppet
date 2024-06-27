<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="theme-color" content="#712cf9">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Visualizar Pet</title>
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
        <?php $dados_pet  = $dados['dados_pet']; ?>
        <!-- Conteúdo -->
        <div class="container">
            <h2 class="pb-2 border-bottom">Dados Pet</h2>
            <form class="row g-3" action="<?=URL?>/pets/editar/<?=$dados_pet['id']?>" method="POST">
                <div class="col-md-6">
                    <label class="form-label">Nome<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="nome" value="<?=$dados_pet['nome']?>" style="text-transform: uppercase;" maxlength="50" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Espécie<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="especie" value="<?=$dados_pet['especie']?>" style="text-transform: uppercase;" maxlength="50" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Data Nascimento</label>
                    <input type="date" class="form-control" name="dataNascimento" value="<?=$dados_pet['dataNascimento']?>" style="text-transform: uppercase;">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Sexo<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="sexo" value="<?=$dados_pet['sexo']?>" style="text-transform: uppercase;" maxlength="50" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Raça<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="raca" value="<?=$dados_pet['raca']?>" style="text-transform: uppercase;" maxlength="50" required>
                </div>
                <div class="col-md-12">
                    <a href="<?=URL?>/pets/detalhar/<?=$dados_pet['id']?>" class="btn btn-secondary">Voltar</a>
                    <button class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#atualizar_dados">Atualizar Dados</button>
                </div>

                <!-- MODAL -->
                <div class="modal fade" id="atualizar_dados" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmar Edição</h1>
                            </div>
                            <div class="modal-body">
                                Você deseja atualizar os dados desse pet?
                            </div>
                            <div class="modal-footer justify-content-start">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                <button class="btn btn-warning" type="submit" name="atualizar_dados">Atualizar</button>
                            </div>
                        </div>
                    </div>
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