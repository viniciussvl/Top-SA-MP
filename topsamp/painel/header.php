<?php
include("../inc/config.php");
require_once("../class/Usuario.class.php");
require_once("../class/Servidor.class.php");

session_start();

if (!isset($_SESSION['usuarioLogado'])) {
    echo "<div style='color: red; text-align: center; font-size: 1.6em;' class='acesso-negado'>
            <p>Você precisa estar logado para acessar essa área!</p>
            <a href='$url'>Voltar</a>
          </div>";
    die;
}

$email = $_SESSION['usuarioLogado'];
$u = new Usuario;
$usuario = $u->infoUsuario($email);
foreach ($usuario as $row) {
    $idDono = $row['id'];
    $nome = $row['nome'];
}

// Logout - Sair
if (isset($_GET['sair']) && $_GET['sair'] == "true") {
    $u->deslogar();
}


// Alertas
if (isset($_GET['server']) && $_GET['server'] == "add") {
    echo "<script>alert('Servidor adicionado com sucesso!');</script>";
}

if (isset($_GET['server']) && $_GET['server'] == "deletado") {
    echo "<script>alert('Servidor deletado com sucesso!');</script>";
}

if (isset($_GET['erro']) && $_GET['erro'] == "limite") {
    echo "<script>alert('Você já possui 3 servidores cadastrados!');</script>";
}

if (isset($_GET['erro']) && $_GET['erro'] == "inexistente") {
    echo "<script>alert('Servidor está offline ou não existe, tente novamente mais tarde!');</script>";
}


if (isset($_GET['excluir']) && is_numeric($_GET['excluir'])) {
    $id = preg_replace("/[^0-9\s]/", "", $_GET['excluir']);
    $s = new Servidor;
    $delete = $s->deletarServidor($id);
    if($delete){
        header("Location: index.php?server=deletado");
    }
}
?>

<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Top SA-MP - Painel de Controle</title>
        <link rel="icon" href="../assets/img/favicon.png" type="image/x-icon">
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/estilo.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        
    </head>
    <body>

        <!--  Novo servidor -->
        <div class="modal fade" id="novoServidor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Cadastrar um novo servidor</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="add.php" class="form-horizontal">
                            <div class="form-group">
                                <label for="nome" class="col-sm-2 control-label">Nome</label>
                                <div class="col-sm-10">
                                    <input type="text" minlength="6" maxlength="32" class="form-control" id="nome" name="nome" placeholder="Exemplo: Brasil Vida Real [RPG]" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ip" class="col-sm-2 control-label">IP</label>
                                <div class="col-sm-10">
                                    <input type="text" minlength="12" maxlength="32" class="form-control" id="ip" name="ip" placeholder="IP sem Porta" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="porta" class="col-sm-2 control-label">Porta</label>
                                <div class="col-sm-10">
                                    <input type="text" minlength="3" maxlength="8" class="form-control" id="porta" name="porta" placeholder="Exemplo: 7777" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="site" class="col-sm-2 control-label">Site/Fórum</label>
                                <div class="col-sm-10">
                                    <input type="text" minlength="8" maxlength="40"  class="form-control" id="site" name="site" placeholder="Cole o link aqui, por exemplo http://www.topsamp.com.br" required>
                                </div>
                            </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-success"><i class='glyphicon glyphicon-pencil'></i> Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>