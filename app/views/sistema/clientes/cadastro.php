<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="theme-color" content="#712cf9">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastrar Cliente</title>
        <link href="<?=URL?>/public/css/bootstrap.min.css" rel="stylesheet">
        <script src="<?=URL?>/public/js/color-modes.js"></script>
        <script src="<?=URL?>/public/js/jquery/jquery-3.7.1.min.js"></script>
        <script src="<?=URL?>/public/js/jquery/jquery.mask.min.js"></script>
        <script src="<?=URL?>/public/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <!-- HEADER -->
        <?php include_once '../app/views/sistema/header.php'; ?>
        <?php $dados_cliente  = $dados['dados_cliente']; ?>
        <!-- Conteúdo -->
        <div class="container">
            <h2 class="pb-2 border-bottom">Cadastrar Cliente</h2>
            <form class="row g-3" method="POST" action="<?=URL?>/clientes/cadastrar">
                <div class="col-md-6">
                    <label class="form-label">Nome<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="nome" value="<?=$dados_cliente['nome']?>" style="text-transform: uppercase;" maxlength="50" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">CPF<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="cpf" value="<?=$dados_cliente['cpf']?>" style="text-transform: uppercase;" maxlength="11" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Endereço<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="endereco" value="<?=$dados_cliente['endereco']?>" style="text-transform: uppercase;" maxlength="50" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Bairro<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="bairro" value="<?=$dados_cliente['bairro']?>" style="text-transform: uppercase;" maxlength="50" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Cidade<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="cidade" value="<?=$dados_cliente['cidade']?>" style="text-transform: uppercase;" maxlength="50" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Telefone<sup class="text-danger">*</sup></label>
                    <input type="number" class="form-control" name="telefone" value="<?=$dados_cliente['telefone']?>" maxlength="11" required>
                </div>
                <div class="col-md-12">
                    <a href="<?=URL?>/clientes" class="btn btn-secondary">Voltar</a>
                    <button type="submit" name="cadastrar_cliente" class="btn btn-success">Cadastrar</button>
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