<?php
    /**
    * Classe Connection
    * 
    * Esta classe representa uma conexão com o banco de dados MySQL utilizando PDO.
    */
    class Connection
    {
        /**
        * Variáveis privadas para armazenar informações de conexão.
        */
        private $host = 'localhost';
        private $dbname = 'zamppet';
        private $username = 'root';
        private $password = 'Informix@2023';
        private $port = '3306';
        private $dbh; // Objeto PDO para a conexão
        private $stmt; // Objeto PDOStatement para execução de consultas preparadas

        /**
        * Método construtor da classe.
        * 
        * Constrói a conexão PDO com o banco de dados utilizando as informações fornecidas.
        */
        public function __construct() {
            // Constrói a string de conexão usando os dados fornecidos
            $dns = 'mysql:host='.$this -> host.';port='.$this -> port.';dbname='.$this -> dbname;

            // Define as opções da conexão PDO
            $options = [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

            try {
                // Tenta estabelecer a conexão com o banco de dados
                $this -> dbh = new PDO($dns, $this -> username, $this -> password, $options);
            } catch (\PDOException $e) {
                // Em caso de erro, imprime o erro e encerra o script
                print "ERRO: $e";
                die();
            }
        }

        /**
        * Prepara uma consulta SQL para execução posterior.
        * 
        * @param string $sql A consulta SQL a ser preparada.
        * @return void
        */
        public function query(string $sql) {
            // Prepara a consulta usando o objeto PDO e armazena no objeto PDOStatement
            $this -> stmt = $this -> dbh -> prepare($sql);
        }

        /**
        * Associa um valor a um parâmetro na consulta preparada.
        * 
        * @param mixed $parameter O nome do parâmetro na consulta preparada.
        * @param mixed $value O valor a ser associado ao parâmetro.
        * @param int|null $type (Opcional) O tipo de dados do parâmetro. Se não especificado, tenta inferir automaticamente.
        * @return void
        */
        public function bind(mixed $parameter, mixed $value, int $type = null) {
            // Se o tipo não for especificado, tenta inferir automaticamente
            if (is_null($type)) {
                switch (true) {
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;
                    default:
                        $type = PDO::PARAM_STR;
                        break;
                }
            }

            // Associa o valor ao parâmetro na consulta preparada
            $this -> stmt -> bindValue($parameter, $value, $type);
        }

        /**
        * Executa a consulta preparada.
        * 
        * @return bool Retorna true se a execução foi bem-sucedida, senão false.
        */
        public function executeQuery() {
            return $this -> stmt -> execute(); // Retorna true se a execução foi bem-sucedida, senão false
        }

        /**
        * Retorna a primeira linha do resultado da consulta.
        * 
        * @return array|null Retorna a primeira linha como um array associativo se houver resultados, senão retorna null.
        */
        public function fetchSingleResult() {
            $this -> executeQuery(); // Executa a consulta
            return $this -> stmt -> fetch(PDO::FETCH_ASSOC); // Retorna a primeira linha como um array associativo
        }

        /**
        * Retorna todas as linhas do resultado da consulta.
        * 
        * @return array Retorna todas as linhas como um array de arrays associativos.
        */
        public function fetchAllResults() {
            $this -> executeQuery(); // Executa a consulta
            return $this -> stmt -> fetchAll(PDO::FETCH_ASSOC); // Retorna todas as linhas como um array de arrays associativos
        }

        /**
        * Retorna o número de linhas afetadas pela última operação.
        *
        * @return int O número de linhas afetadas pela última operação.
        */
        public function getNumberResults() {
            return $this -> stmt -> rowCount(); // Retorna o número de linhas afetadas pela última operação
        }

        /**
        * Inicia uma transação.
        */
        public function startTransaction() {
            $this -> dbh -> beginTransaction();
        }

        /**
        * Confirma a transação atual.
        */
        public function realizeCommit() {
            $this -> dbh -> commit();
        }

        /**
        * Reverte a transação atual.
        */
        public function realizeRollBack() {
            $this -> dbh -> rollBack();
        }

        /**
        * Obtém o ID gerado pela última operação de inserção.
        *
        * @return mixed O ID gerado pela última instrução INSERT.
        */
        public function getLastInsertId() {
            return $this -> dbh -> lastInsertId(); // Retorna o ID gerado pela última instrução INSERT
        }
    }