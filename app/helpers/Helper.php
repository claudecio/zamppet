<?php
    class Helper {

        public static function redirecionarUsuario(string $caminho) {
            ob_start();
            header("Location:".URL.DIRECTORY_SEPARATOR.$caminho);
            ob_end_flush();
            exit();
        }

        public static function gerarNotificacao(string $tipo, string $mensagem) {
            $_SESSION['notificacoes'] = "<br><div class='alert alert-$tipo alert-dismissible fade show' role='alert'>".
                                    "$mensagem".
                                    "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>".
                                    "</div>";
        }

        public static function mostrarNotificacao() {
            if (isset($_SESSION['notificacoes']))
            {
                print $_SESSION['notificacoes'];
                unset($_SESSION['notificacoes']);
            }
        }
    }