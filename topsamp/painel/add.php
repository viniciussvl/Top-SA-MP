<?php
session_start();
if (!isset($_SESSION['usuarioLogado'])) {
    header("Location: index.php");
} else {
    require_once("../class/Servidor.class.php");
    require_once("../class/Usuario.class.php");
    require_once("../class/SampQuery.class.php");
    if (isset($_POST['nome']) && isset($_POST['ip']) && isset($_POST['porta']) && isset($_POST['site'])) {
        $nome = preg_replace("/[^a-zA-Z0-9\ \-]/", "", $_POST['nome']);
        $ip = preg_replace("/[^a-zA-Z0-9\.]/", "", $_POST['ip']);
        $porta = preg_replace("/[^0-9\s]/", "", $_POST['porta']);
        $query = new SampQuery($ip, $porta);
        if (!$query->connect()) {
            echo "<script>location.href='http://topsamp.com.br/painel/index.php?erro=inexistente';</script>";
            die;
        }
        $site = preg_replace("/[^a-zA-Z0-9\.\:\/\-]/", "", $_POST['site']);
        $dono = $_SESSION['usuarioLogado'];
        $u = new Usuario;
        $usuario = $u->infoUsuario($dono);
        foreach ($usuario as $row) {
            $idDono = $row['id'];
        }
        $s = new Servidor;
        $server = $s->adicionarServidor($nome, $ip, $porta, $site, $idDono);
        if ($server) {
            echo "<script>location.href='http://topsamp.com.br/painel/index.php?server=add';</script>";
        } else {
            echo "<script>location.href='http://topsamp.com.br/painel/index.php?erro=limite';</script>";
        }
    } else {
        header("Location: index.php");
    }
}
?>