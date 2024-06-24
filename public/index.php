<?php

    // Inclui o arquivo de configuração
    include '../app/conf/config.php';

    // Inclui o arquivo de autoload
    include '../app/autoload.php';

    // Inicia o buffer de saída
    ob_start();

    // Inicia ou resgata a sessão existente
    session_start();

    // Instancia um objeto da classe Router
    $router = new Router;

    // Instancia um objeto da classe Connection
    $connection = new Connection;