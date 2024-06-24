<?php
    /**
    * Classe Controller
    * 
    * Classe base para todos os controladores.
    */
    class Controller
    {
        /**
         * Carrega uma view com os dados fornecidos.
         *
         * @param string $view O nome da view a ser carregada.
         * @param array $dados (opcional) Dados a serem passados para a view.
         */
        public function view(string $view, array $dados = []) {
            if(!file_exists('../app/views/'.$view.'.php')) {
                Helper::gerarNotificacao("warning", "A view requisitada não existe");
            }

            require_once '../app/views/'.$view.'.php';
        }

        /**
         * Carrega e instancia um model.
         *
         * @param string $model O nome do model a ser carregado.
         * @return object Uma instância do model.
         */
        public function model(string $model) {
            if(!file_exists('../app/models/'.$model.'.php')) {
                Helper::gerarNotificacao("warning", "O model requisitado não existe");
            }

            require_once '../app/models/'.$model.'.php';
            return new $model;
        }
    }