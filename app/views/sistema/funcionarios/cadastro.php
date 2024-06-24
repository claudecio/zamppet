<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="theme-color" content="#712cf9">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastrar Funcionario</title>
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
            <h2 class="pb-2 border-bottom">Cadastrar Funcionário</h2>
            <form class="row g-3" method="POST" action="<?=URL?>/funcionarios/cadastrar">
                <div class="col-md-8">
                    <label class="form-label">Nome<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="nome" value="<?=$dados_funcionario['nome']?>" style="text-transform: uppercase;" maxlength="50" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Data Admissão<sup class="text-danger">*</sup></label>
                    <input type="date" class="form-control" name="data_admissao" value="<?=$dados_funcionario['data_admissao']?>" style="text-transform: uppercase;" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">CPF<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="cpf" value="<?=$dados_funcionario['cpf']?>" style="text-transform: uppercase;" maxlength="11" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Cargo<sup class="text-danger">*</sup></label>
                    <select class="form-select" name="funcionarios_cargos_id" required>
                        <option disabled selected></option>
                        <option value="1_GERENTE">GERENTE</option>
                        <option value="2_VETERINÁRIO">VETERINÁRIO</option>
                        <option value="3_RECEPCIONISTA">RECEPCIONISTA</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <a href="<?=URL?>/funcionarios" class="btn btn-secondary">Voltar</a>
                    <button type="submit" name="cadastrar_funcionario" class="btn btn-success">Cadastrar</button>
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