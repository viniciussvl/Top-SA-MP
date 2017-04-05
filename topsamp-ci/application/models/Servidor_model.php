<?php

class Servidor_model extends CI_Model {

    public function listarServidores($select, $where = null, $limit = null, $offset = null) {
        $this->db->select($select);
        if ($where) {
            $this->db->where($where);
        }
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('votos', 'DESC');
        $servidores = $this->db->get('servidor')->result();
        return $servidores;
    }

    public function countAll() {
        return $this->db->count_all('servidor'); // Retorna a quantidade de linhas da tabela
    }

    public function adicionarServidor($dados) {
        $nome = $dados['nome'];
        $slug = slug($nome);
        $idDono = $this->session->userdata('usuarioLogado')['id'];
        $select = array('nome');
        $where = "idDono = '$idDono'";
        $this->db->select($select);
        $this->db->where($where);
        //$totServers = $this->db->get('servidor')->num_rows();
        $ip = preg_replace("/[^a-zA-Z0-9\.\-]/", "", $dados['ip']);
        $porta = preg_replace("/[^0-9\s]/", "", $dados['porta']);
        // require('application/libraries/SampQuery.php');
        /* $query = new SampQuery($ip, $porta);
        if (!$query->connect()) {
            echo "Servidor não existe ou está offline!";
        } else{ */
            $site = preg_replace("/[^a-zA-Z0-9\.\:\/\-]/", "", $dados['site']);
            $frase = $dados['frase'];
            $data = date('Y-m-d');
            $select = array('ip', 'nome', 'porta');
            $where = "ip = '$ip' AND porta = '$porta'";
            $this->db->select($select);
            $this->db->where($where);
            $server = $this->db->get('servidor')->result();
            if (!$server) {
                $porta = rand(5, 15);
                $insert = array('nome' => $nome, 'slug' => $slug, 'ip' => $ip, 'porta' => $porta, 'dataRegistro' => $data, 'site' => $site, 'frase' => $frase, 'idDono' => $idDono);
                $this->db->insert('servidor', $insert);
                return true;
            } else {
                return false;
            }
        // }
    }

    public function alterarServidor($dados) {
        $idDono = $this->session->userdata('usuarioLogado')['id'];
        $nome = $dados['nome'];
        $ip = preg_replace("/[^a-zA-Z0-9\.\-]/", "", $dados['ip']);
        $porta = preg_replace("/[^0-9\s]/", "", $dados['porta']);
        $site = preg_replace("/[^a-zA-Z0-9\.\:\/\-]/", "", $dados['site']);
        $idServer = preg_replace("/[^0-9\s]/", "", $dados['idServer']);
        $frase = $dados['frase'];
        $slug = slug($nome);
        $data = array('nome' => $nome, 'ip' => $ip, 'slug' => $slug, 'porta' => $porta, 'frase' => $frase, 'site' => $site);
        $this->db->where('id', $idServer);
        $this->db->update('servidor', $data);
        return true;
    }

    public function deletarServidor($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('servidor')) {
            return true;
        }
    }

    public function verificarVoto($ip, $data) {
        $select = array('ip', 'data', 'id');
        $where = "ip = '$ip' AND data = '$data'";
        $this->db->where($where);
        $this->db->select($select);
        $result = $this->db->get('votos')->result();
        return $result;
    }

    public function getVotosHoje($idServer) {
        $data = date('Y-m-d');
        $select = array('id', 'data');
        $where = "idServidor = '$idServer' AND data = '$data'";
        $this->db->where($where);
        $this->db->select($select);
        $total = $this->db->get('votos')->num_rows();
        if ($total > 0) {
            return $total;
        } else {
            return false;
        }
    }

    public function votar($id, $ip, $data, $hora) {
        $select = array('slug', 'id');
        $where = "id = '$id'";
        $this->db->where($where);
        $this->db->select($select);
        $servidor = $this->db->get('servidor')->result();
        $insert = array('idServidor' => $id, 'ip' => $ip, 'data' => $data, 'hora' => $hora);
        $this->db->insert('votos', $insert);
        $q = $this->db->query("UPDATE servidor set votos = votos + 1 WHERE id = '{$id}'");
        return $q;
    }

}
