<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sobre extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->template->load('template_view', 'sobre_view');
    }
}
