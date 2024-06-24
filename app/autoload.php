<?php
    /**
    * Classe responsável por carregar automaticamente arquivos de classes PHP quando são necessários.
    */
    spl_autoload_register(
        function ($controller) {
            // Lista de diretórios onde as classes podem ser encontrada
            $dirs = [
                'libraries',
                'helpers'
            ];

            // Percorre os diretórios para encontrar o arquivo da classe
            foreach ($dirs as $dir) {
                // Caminho completo do arquivo da classe
                $file = (__DIR__.DIRECTORY_SEPARATOR.$dir.DIRECTORY_SEPARATOR.$controller.'.php');

                // Verifica se o arquivo da classe existe e o inclui
                if (file_exists($file)) {
                    require_once  $file;
                }
            }
        }
    );