<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();

$autoload['libraries'] = array('database', 'session', 'template', 'form_validation', 'pagination');

$autoload['drivers'] = array();

$autoload['helper'] = array('url', 'string', 'text', 'funcoes', 'captcha');

$autoload['config'] = array();

$autoload['language'] = array();

$autoload['model'] = array('Servidor_model' => 'server');
