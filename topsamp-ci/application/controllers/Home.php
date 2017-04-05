<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public $select = array('nome', 'ip', 'id', 'porta', 'site', 'votos', 'status', 'frase', 'slug', 'dataRegistro');

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $config = array(
            "base_url" => base_url('servidores/p'),
            "per_page" => 50,
            "num_links" => 3,
            "uri_segment" => 3,
            "total_rows" => $this->server->countAll(),
            "full_tag_open" => "<ul class='pagination'>",
            "full_tag_close" => "</ul>",
            "first_link" => "Primeira",
            "last_link" => "Última",
            "first_tag_open" => "<li>",
            "first_tag_close" => "</li>",
            "prev_link" => "&laquo;",
            "prev_tag_open" => "<li class='prev'>",
            "prev_tag_close" => "</li>",
            "next_link" => "&raquo;",
            "next_tag_open" => "<li class='next'>",
            "next_tag_close" => "</li>",
            "last_tag_open" => "<li>",
            "last_tag_close" => "</li>",
            "cur_tag_open" => "<li class='active'><a href='#'>",
            "cur_tag_close" => "</a></li>",
            "num_tag_open" => "<li>",
            "num_tag_close" => "</li>"
        );

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $limit = $config['per_page'];
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $where = "id IS NOT NULL";
        $servidores = $this->server->listarServidores($this->select, $where, $limit, $offset);
        $data['servidores'] = $servidores;
        $data['offset'] = $offset;
        $this->template->load('template_view', 'home/home_view', $data);
        $users = $this->getUsuariosOnline();
        $this->session->set_userdata('users', $users);
    }

    public function servidor($id) {
        $detalhes = $this->server->listarServidores($this->select, "id = '{$id}'");
        if (!$detalhes):
            redirect('');
        endif;
        $data['detalhes'] = $detalhes;
        $this->template->load('template_view', 'home/detalhes_servidor_view', $data);
    }

    public function erro() {
        $this->template->load('template_view', 'erro_view');
    }

    public function votar($id) {
        $data = date('Y-m-d');
        $hora = date('H:i');
        $ip = buscarIp();
        $verificarVoto = $this->server->verificarVoto($ip, $data);
//        $totalVotos = $this->db->query("SELECT votos FROM servidor WHERE id = '{$id}'")->result()[0]->votos;
//        if (!$totalVotos) {
//            redirect('');
//        }
        if ($verificarVoto) {
            $this->session->set_flashdata('erro', 'Você já votou, poderá votar novamente às 00:00!');
            redirect('');
        } else {
            $servidor = $this->server->listarServidores($this->select, "id = '{$id}'");
            $dados['servidor'] = $servidor;
            $this->template->load('template_view', 'home/votar_view', $dados);
        }
    }

    public function confirmarVoto($id) {
        if (!$this->input->post('g-recaptcha-response')) {
            $this->session->set_flashdata('erro', 'Você não confirmou o captcha!');
            redirect("votar/{$id}/{$slug}");
        }
        $ip = buscarIp();
        $data = date('Y-m-d');
        $verificarVoto = $this->server->verificarVoto($ip, $data);
        if ($verificarVoto) {
            $this->session->set_flashdata('erro', 'Você já votou, poderá votar novamente às 00:00!');
            redirect('');
        }
        $hora = date('H:i');
        $this->server->votar($id, $ip, $data, $hora);
        $this->session->set_flashdata('sucesso', 'Seu voto foi computado com sucesso, poderá votar novamente às 00:00!');
        redirect('');
    }

    public function verificaSeVotou() {
        if (!$this->input->post('ip')):
            redirect('');
        endif;
        $ip = $this->input->post('ip');
        $data = $this->input->post('data');
        $verifica = $this->server->verificarVoto($ip, $data);
        if ($verifica) {
            echo '0';
        } else {
            echo '1';
        }
    }

    public function getUsuariosOnline() {
        $tempo = time();
        $ip = buscarIp();
        $select = $this->db->query("SELECT id, id, tempo FROM online WHERE ip = '$ip'");
        $linhas = $select->num_rows();
        if ($linhas == 0) {
            $insert = array('ip' => $ip, 'tempo' => $tempo);
            $this->db->insert('online', $insert);
        } else {
            $ip = buscarIp();
            $atualiza = $this->db->query("UPDATE online SET tempo ='$tempo' WHERE ip = '$ip'");
        }
        $delete = $this->db->query("DELETE FROM online WHERE tempo <'$tempo'" . -"40");
        $query = $this->db->query('SELECT * FROM online');
        $totOnline = $query->num_rows();
        return $totOnline;
    }

}
