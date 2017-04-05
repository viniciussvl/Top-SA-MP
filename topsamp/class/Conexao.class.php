<?php

class Conexao {

    public function __construct() {
        $this->conectar();
    }

    // Métodos
    public function conectar() {
        try {
            if ($_SERVER['SERVER_NAME'] == 'localhost'):
                $host = "localhost";
                $name = "topsamp";
                $user = "root";
                $pass = "";
            endif;
            // Conexao com banco MySQL
            $this->conn = new PDO("mysql:host={$host};dbname={$name}", $user, $pass);

            // Define para que o PDO lance exceções na ocorrência de erros
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "DEU ERRO!!";
            echo 'ERROR: ' . $e->getMessage();
        }
    }

}

?>