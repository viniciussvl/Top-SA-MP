<?php

// Url Absoluta
$pasta = ($_SERVER['SERVER_NAME'] == "localhost") ? 'topsamp' : 'public_html';
$url = "http://" . $_SERVER['SERVER_NAME'] . '/' . $pasta . '/';

// Definição da Data
date_default_timezone_set('America/Sao_Paulo');
                   
