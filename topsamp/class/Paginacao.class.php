<?php

require_once("Conexao.class.php");

class Paginacao extends Conexao {
    public $sql;
    public $conn;
    private $registros;
    private $total;
    private $incio;
    private $numPaginas;
    private $pagina;

    public function getRegistros() {
        try {
            $consulta = $this->conn->query($this->sql);
            $this->total = $consulta->rowCount();
        } catch (PDOException $ex) {
            die($ex);
        }
    }

    public function calcularRegistros($registros, $pagina) {
        $this->pagina = $pagina;
        $this->registros = $registros;
        $this->numPaginas = ceil($this->total / $this->registros);
        $this->inicio = ($this->registros * $this->pagina) - $this->registros;
        
    }

    public function getNumPaginas(){
        return $this->numPaginas;
    }
    
    public function getInicio(){
        return $this->inicio;
    }
    
    public function getResultados() {
        try {
            $sth = $this->conn->prepare($this->sql . " ORDER BY votos DESC" . " LIMIT $this->inicio, $this->registros");
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die($e);
        }
    }

}
