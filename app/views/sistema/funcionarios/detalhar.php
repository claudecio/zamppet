<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="theme-color" content="#712cf9">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Visualizar Funcionário</title>
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
            <h2 class="pb-2 border-bottom">Dados Funcionario</h2>
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label">Nome<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="nome" value="<?=$dados_funcionario['nome']?>" style="text-transform: uppercase;" maxlength="50" disabled>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Data Admissão</label>
                    <input type="date" class="form-control" name="data_admissao" value="<?=$dados_funcionario['data_admissao']?>" style="text-transform: uppercase;" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label">CPF<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="cpf" value="<?=$dados_funcionario['cpf']?>" style="text-transform: uppercase;" maxlength="11" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Cargo<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="cargo" value="<?=$dados_funcionario['cargo']?>" style="text-transform: uppercase;" disabled>
                </div>
                <div class="col-md-12">
                    <label class="form-label">E-mail<sup class="text-danger">*</sup></label>
                    <input type="email" class="form-control" name="email" value="<?=$dados_funcionario['email']?>" style="text-transform: lowercase;" disabled>
                </div>
                <div class="col-md-12">
                    <a href="<?=URL?>/funcionarios" class="btn btn-secondary">Voltar</a>
                    <a href="<?=URL?>/funcionarios/editar/<?=$dados_funcionario['id']?>" class="btn btn-warning">Editar Informações</a>
                </div>
            </div>
        </div>
        <div class="container py-4">
            <footer class="pt-3 mt-4 text-body-secondary border-top">
                Copyright  &copy;<?php echo date("Y");?> Zamp Pet.
            </footer>
        </div>
    </body>
</html>