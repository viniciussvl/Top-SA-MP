<?php

class Usuario_model extends CI_Model {

    public function verificarUsuario($dados) {
        $email = preg_replace("/[^a-zA-Z0-9\.\@]/", "", $dados['email']);
        $senha = preg_replace("/[^a-zA-Z0-9]/", "", $dados['senha']);
        $senha = sha1($senha);
        $select = array('email', 'id', 'nome');
        $where = "email = '$email' AND senha = '$senha'";
        $this->db->where($where);
        $this->db->select($select);
        $usuario = $this->db->get('usuario')->result();
        return $usuario;
    }

    public function logarUsuario($dados) {
        $arr = array(
            'id' => $dados->id,
            'email' => $dados->email,
            'nome' => $dados->nome,
        );
        $this->session->set_userdata('usuarioLogado', $arr);
    }

    public function registrarUsuario($dados) {
        $verifica = $this->verificarUsuario($dados);
        if ($verifica) {
            return false;
        } else {
            $nome = $dados['nome'];
            if(strstr($nome, "'")){
                redirect('');
            }
            $email = preg_replace("/[^a-zA-Z0-9\.\@]/", "", $dados['email']);
            $senha = preg_replace("/[^a-zA-Z0-9]/", "", $dados['senha']);
            $senha = sha1($senha);
            $insert = array('nome' => $nome, 'email' => $email, 'senha' => $senha);
            $this->db->insert('usuario', $insert);
            return true;
        }
    }

}
