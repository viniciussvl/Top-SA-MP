<?php

require_once("Conexao.class.php");
class Usuario extends Conexao {
    public $conn;
    
    public function novoUsuario($email, $senha, $nome) {
        try {
            $sth = $this->conn->prepare("SELECT email, senha FROM usuario WHERE email = ?");
            $sth->bindValue(1, $email, PDO::PARAM_STR);
            $sth->execute();
            if ($sth->rowCount() > 0) {
                return false;
            } else {
                $senha = sha1($senha);
                $sql = "INSERT INTO usuario (email, senha, nome) VALUES (?, ?, ?)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(1, $email);
                $stmt->bindValue(2, $senha);
                $stmt->bindValue(3, $nome);
                $stmt->execute();
                return true;
            }
        } catch (PDOException $e) {
            die($e);
        }
    }

    public function logar($email, $senha) {
        try {
            $senha = sha1($senha);
            $sth = $this->conn->prepare("SELECT email, senha FROM usuario WHERE email = ? AND senha = ?");
            $sth->bindValue(1, $email, PDO::PARAM_STR);
            $sth->bindValue(2, $senha, PDO::PARAM_STR);
            $sth->execute();
            if ($sth->rowCount() > 0) {
                $_SESSION['usuarioLogado'] = $email;
                header("Location: painel/index.php");
            } else {
                header("Location: index.php?erro=dados");
            }
        } catch (PDOException $ex) {
            die($e);
        }
    }

    public function deslogar() {
        session_destroy();
        header("Location: ../index.php");
    }

    public function infoUsuario($email) {
        try {
            $sth = $this->conn->prepare("SELECT id, nome FROM usuario WHERE email = ?");
            $sth->bindValue(1, $email, PDO::PARAM_STR);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die($e);
        }
    }

}
