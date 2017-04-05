<?php

require_once("Conexao.class.php");

class Servidor extends Conexao {

    // Atributos
    public $conn;

    public function getUsuariosOnline() {
    	try{
		    $tempo = time();
		    $ip = $_SERVER['REMOTE_ADDR'];
		    $select = $this->conn->prepare("SELECT id, ip, tempo FROM online WHERE ip = ?");
		    $select->bindValue(1, $ip, PDO::PARAM_STR);
		    $select->execute();
		    if ($select->rowCount() == 0) {
		    	$insert = $this->conn->prepare("INSERT INTO online (ip, tempo) VALUES (?, ?)");
		    	$insert->bindValue(1, $ip, PDO::PARAM_STR);
		    	$insert->bindValue(2, $tempo, PDO::PARAM_STR);
		        $insert->execute();
		    } else {
		        $ip = $_SERVER['REMOTE_ADDR'];
		        $atualiza = $this->conn->prepare("UPDATE online SET tempo = ? WHERE ip = ?");
		        $atualiza->bindValue(1, $tempo);
	            $atualiza->bindValue(2, $ip);
		        $atualiza->execute();
		    }
		    $delete = $this->conn->prepare("DELETE FROM online WHERE tempo < ? " . -"120");
		    $delete->bindValue(1, $tempo);
		    $delete->execute();
		    $query = $this->conn->query('SELECT * FROM online');
		    $totOnline = $query->rowCount();
		    return $totOnline;
		} catch (PDOException $e){
			die($e);
		}	    
	}

    // Métodos  
    public function listarServidores($op) {
        try {
            if ($op == "todos") {
                $sth = $this->conn->query('SELECT * FROM servidor ORDER BY votos DESC');
            } else {
                $sth = $this->conn->prepare("SELECT ip, id, porta, nome, site, votos, cliques, dataRegistro FROM servidor WHERE dono = ?");
                $sth->bindValue(1, $op, PDO::PARAM_STR);
                $sth->execute();
            }
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die($e);
        }
    }

    public function listarServidor($ip, $porta) {
        try {
            $sth = $this->conn->prepare("SELECT ip, porta FROM servidor WHERE ip = ? AND porta = ?");
            $sth->bindValue(1, $ip, PDO::PARAM_STR);
            $sth->bindValue(2, $porta, PDO::PARAM_INT);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die($e);
        }
    }

    public function retornaServidor($id, $dono) {
        try {
            $sth = $this->conn->prepare("SELECT * FROM servidor WHERE id = ? AND dono = ?");
            $sth->bindValue(1, $id, PDO::PARAM_INT);
            $sth->bindValue(2, $dono, PDO::PARAM_INT);
            $sth->execute();
            if ($sth->rowCount() > 0) {
                return $sth->fetchAll(PDO::FETCH_ASSOC);
            } else {
                header("Location: index.php");
            }
        } catch (PDOException $ex) {
            die($ex);
        }
    }

    public function getVotosHoje($idServer) {
        try {
            $dataAtual = date('Y-m-d');
            $sth = $this->conn->prepare("SELECT * FROM votos WHERE idServidor = ? AND data = ?");
            $sth->bindValue(1, $idServer, PDO::PARAM_INT);
            $sth->bindValue(2, $dataAtual);
            $sth->execute();
            $totVotos = $sth->rowCount();
        } catch (PDOException $ex) {
            die($ex);
        }
        return $totVotos;
    }

    public function setAcesso($id) {
        try {
            $id = preg_replace("/[^0-9\s]/", "", $id);
            $sql = "UPDATE servidor SET cliques = cliques + 1 WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();
        } catch (PDOException $ex) {
            die($ex);
        }
    }

    public function getBusca($p) {
        try {
            $sth = $this->conn->prepare("SELECT * FROM servidor WHERE nome LIKE '%?%'");
            $sth->bindValue(1, $p, PDO::PARAM_STR);
            $sth->execute();
            if ($sth->rowCount() > 0) {
                return $sth->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        } catch (PDOException $ex) {
            die($ex);
        }
    }

    public function getServer($id) {
        try {
            $id = preg_replace("/[^0-9\s]/", "", $id);
            $sth = $this->conn->prepare("SELECT * FROM servidor WHERE id = ?");
            $sth->bindValue(1, $id, PDO::PARAM_INT);
            $sth->execute();
            if ($sth->rowCount() > 0) {
                return $sth->fetchAll(PDO::FETCH_ASSOC);
            } else {
                header("Location: index.php");
            }
        } catch (PDOException $ex) {
            die($ex);
        }
    }

    public function alterarServidor($id, $nome, $ip, $porta, $site) {
        try {
            $porta = preg_replace("/[^0-9\s]/", "", $porta);
            $id = preg_replace("/[^0-9\s]/", "", $id);
            $sql = "UPDATE servidor SET nome = ?, ip = ?, porta = ?, site = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(1, $nome);
            $stmt->bindValue(2, $ip);
            $stmt->bindValue(3, $porta);
            $stmt->bindValue(4, $site);
            $stmt->bindValue(5, $id);
            $stmt->execute();
            header("Location: editar.php?id=$id&editado=true");
        } catch (PDOException $e) {
            die($e);
        }
    }

    public function deletarServidor($id) {
        try {
            $id = preg_replace("/[^0-9\s]/", "", $id);
            $sql = "DELETE FROM servidor WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die($e);
        }
        return true;
    }

    public function adicionarServidor($nome, $ip, $porta, $site, $dono) {
        try {
            $sth = $this->conn->prepare("SELECT ip, porta FROM servidor WHERE ip = ? AND porta = ?");
            $sth->bindValue(1, $ip, PDO::PARAM_STR);
            $sth->bindValue(2, $porta, PDO::PARAM_INT);
            $sth->execute();
            if ($sth->rowCount() > 0) {
                echo "Esse servidor já existe no banco de dados!";
            } else {
                $sth = $this->conn->prepare("SELECT * FROM servidor WHERE dono = ?");
                $sth->bindValue(1, $dono, PDO::PARAM_INT);
                $sth->execute();
                if ($sth->rowCount() >= 3) {
                    return false;
                } else {
                    $data = date('Y-m-d');
                    $sql = "INSERT INTO servidor (nome, ip, porta, site, dono, dataRegistro) VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindValue(1, $nome);
                    $stmt->bindValue(2, $ip);
                    $stmt->bindValue(3, $porta);
                    $stmt->bindValue(4, $site);
                    $stmt->bindValue(5, $dono);
                    $stmt->bindValue(6, $data);
                    $stmt->execute();
                }
            }
        } catch (PDOException $e) {
            die($e);
        }
        return true;
    }

    public function votar($ip, $data, $hora, $id) {
        try {
            $id = preg_replace("/[^0-9\s]/", "", $id);
            $sql = "INSERT INTO votos (ip, data, hora, idServidor) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(1, $ip);
            $stmt->bindValue(2, $data);
            $stmt->bindValue(3, $hora);
            $stmt->bindValue(4, $id);
            $stmt->execute();
            $update = "UPDATE servidor SET votos = votos + 1 WHERE id = ?";
            $s = $this->conn->prepare($update);
            $s->bindValue(1, $id);
            $s->execute();
        } catch (PDOException $ex) {
            die($ex);
        }
        return true;
    }

    public function consultaVotoIp($ip, $data, $servidor) {
        try {
            $sth = $this->conn->prepare("SELECT * FROM votos WHERE ip = ? AND data = ?");
            $sth->bindValue(1, $ip, PDO::PARAM_STR);
            $sth->bindValue(2, $data);
            $sth->execute();
        } catch (PDOException $ex) {
            die($ex);
        }
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarIp() {
    $http_client_ip = (isset($_SERVER['HTTP_CLIENT_IP'])) ? $_SERVER['HTTP_CLIENT_IP'] : null;
    $http_x_forwarded_for = (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : null;
    $remote_addr = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : null;
    if (!empty($http_client_ip)) {
        $ip = $http_client_ip;
    } elseif (!empty($http_x_forwarded_for)) {
        $ip = $http_x_forwarded_for;
    } else {
        $ip = $remote_addr;
    }
    return $ip;
}

}
