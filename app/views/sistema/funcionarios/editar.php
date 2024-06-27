<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="theme-color" content="#712cf9">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Funcionario</title>
        <link href="<?=URL?>/public/css/bootstrap.min.css" rel="stylesheet">
        <script src="<?=URL?>/public/js/color-modes.js"></script>
        <script src="<?=URL?>/public/js/jquery/jquery-3.7.1.min.js"></script>
        <script src="<?=URL?>/public/js/jquery/jquery.mask.min.js"></script>
        <script src="<?=URL?>/public/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <!-- HEADER -->
        <?php include_once '../app/views/sistema/header.php'; ?>
        <?php $dados_funcionario  = $dados['dados_funcionario']; ?>
        <!-- Conteúdo -->
        <div class="container">
            <h2 class="pb-2 border-bottom">Cadastrar Cliente</h2>
            <form class="row g-3" method="POST" action="<?=URL?>/funcionarios/editar/<?=$dados_funcionario['id']?>">
                <div class="col-md-8">
                    <label class="form-label">Nome<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="nome" value="<?=$dados_funcionario['nome']?>" style="text-transform: uppercase;" maxlength="50" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Data Admissão</label>
                    <input type="date" class="form-control" name="data_admissao" value="<?=$dados_funcionario['data_admissao']?>" style="text-transform: uppercase;">
                </div>
                <div class="col-md-6">
                    <label class="form-label">CPF<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="cpf" value="<?=$dados_funcionario['cpf']?>" style="text-transform: uppercase;" maxlength="11" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Cargo<sup class="text-danger">*</sup></label>
                    <select class="form-select" name="funcionarios_cargos_id" required>
                        <option disabled selected></option>
                        <option value="1_GERENTE" <?= ($dados_funcionario['funcionarios_cargos_id'] == 1) ? 'selected' : '' ?>>GERENTE</option>
                        <option value="2_VETERINÁRIO" <?= ($dados_funcionario['funcionarios_cargos_id'] == 2) ? 'selected' : '' ?>>VETERINÁRIO</option>
                        <option value="3_RECEPCIONISTA" <?= ($dados_funcionario['funcionarios_cargos_id'] == 3) ? 'selected' : '' ?>>RECEPCIONISTA</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label class="form-label">E-mail<sup class="text-danger">*</sup></label>
                    <input type="email" class="form-control" name="email" value="<?=$dados_funcionario['email']?>" style="text-transform: lowercase;" required>
                </div>
                <div class="col-md-12">
                    <a href="<?=URL?>/funcionarios" class="btn btn-secondary">Voltar</a>
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
                                Você deseja atualizar os dados desse funcionário?
                            </div>
                            <div class="modal-footer justify-content-start">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                <button class="btn btn-warning" type="submit" name="atualizar_dados">Atualizar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="container py-4">
            <footer class="pt-3 mt-4 text-body-secondary border-top">
                Copyright  &copy;<?php echo date("Y");?> Zamp Pet.
            </footer>
        </div>
    </body>
</html>