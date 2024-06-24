<?php
    class HomeController extends Controller {
        
        public function index() {
            if(!isset($_SESSION["informacoes_usuario"])) {
                Helper::redirecionarUsuario("auth/login");
            }

            $this -> view("sistema/inicio/home", []);
        }
    }