<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Home';


$route['servidor/(:any)'] = 'Home/servidor/$1';
$route['votar/(:any)'] = 'Home/votar/$1';
$route['verificaSeVotou'] = 'Home/verificaSeVotou';
$route['servidores/p'] = 'Home';
$route['servidores/p/(:num)'] = "Home";

$route['painel'] = 'Usuario';
$route['registrar'] = 'Usuario/registrar';
$route['logar'] = 'Usuario/logar';
$route['deslogar'] = 'Usuario/deslogar';
$route['novoServidor'] = 'Usuario/novoServidor';
$route['painel/editar/(:any)'] = 'Usuario/editar/$1';
$route['painel/deletar/(:any)'] = 'Usuario/deletar/$1';
$route['captcha'] = 'Captcha';
$route['politica-privacidade'] = 'Politica';
$route['sobre'] = 'Sobre';
$route['projeto'] = 'Projeto';
$route['contato'] = 'Contato';

$route['404_override'] = 'Home/erro';
$route['translate_uri_dashes'] = FALSE;
