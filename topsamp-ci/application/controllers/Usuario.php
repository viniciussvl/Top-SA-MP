<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Usuario_model', 'usuario');
        $this->load->model('Servidor_model', 'servidor');
    }

    public function index() {
        if (!$this->session->userdata('usuarioLogado')) {
            redirect('');
        }
        $id = $this->session->userdata('usuarioLogado')['id'];
        $where = "idDono = '{$id}'";
        $select = array('nome', 'ip', 'slug', 'porta', 'cliques', 'dataRegistro', 'id', 'votos', 'site');
        $data['servidores'] = $this->server->listarServidores($select, $where);
        $this->template->load('painel/template_view', 'painel/home_view', $data);
    }

    public function logar() {
        $dados = $this->usuario->verificarUsuario($this->input->post());
        if (!$dados) {
            echo 'nao logou';
        } else {
            $this->usuario->logarUsuario($dados[0]);
            redirect('painel');
        }
    }

    public function deslogar() {
        $this->session->unset_userdata('usuarioLogado');
        $this->session->set_flashdata('usuarioDeslogado', true);
        redirect('');
    }

    public function registrar() {
        $this->template->load('template_view', 'registrar_view');
        if ($this->input->post()) {
            if($this->usuario->registrarUsuario($this->input->post())){
                $this->session->set_flashdata('sucesso', '...');
            } else{
                $this->session->set_flashdata('erro', '...');
            }
            redirect('registrar');
        }
    }

    public function novoServidor() {
        if ($this->input->post()) {
            $add = $this->servidor->adicionarServidor($this->input->post());
            if(!$add){
                $this->session->set_flashdata('existe', '...');
            } else{
                $this->session->set_flashdata('add', '...');
            }
            redirect('painel');
        }
    }

    public function editar($id) {
        if (!$this->session->userdata('usuarioLogado')) {
            redirect('');
        }
        $idDono = $this->session->userdata('usuarioLogado')['id'];
        $select = array('id', 'nome', 'site', 'slug', 'ip', 'porta', 'frase', 'status');
        $where = "id = '$id' AND idDono = '$idDono'";
        $data['servidores'] = $this->server->listarServidores($select, $where);
        if (!$this->server->listarServidores($select, $where)) {
            redirect('painel');
        }
        $this->template->load('painel/template_view', 'painel/editar_view', $data);
    }
    
    public function deletar($id){
        if(!$this->session->userdata('usuarioLogado')){
            redirect('');
        }
        $idDono = $this->session->userdata('usuarioLogado')['id'];
        $select = array('id');
        $where = "id = '$id' AND idDono = '$idDono'";
        $listar = $this->server->listarServidores($select, $where);
        if(!$listar){
            redirect('painel');
        }
        $data['servidores'] = $listar;
        $deletar = $this->server->deletarServidor($id);
        if($deletar){
            $this->session->set_flashdata('deletado', '...');
            redirect('painel');
        }
    }
    
    public function alterarServidor(){
        if($this->input->post()){
            if($this->servidor->alterarServidor($this->input->post())){
                redirect("painel");
            }  else{
                echo "caiu aqui!";
            }
        }
    }
    


}
