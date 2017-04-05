<?php
require_once("class/Servidor.class.php");

if (!isset($_GET['id']) && !is_numeric($_GET['id'])) {
    header("Location: index.php");
} else {
    $id = preg_replace("/[^0-9\s]/", "", $_GET['id']);
    $s = new Servidor;
    $s->setAcesso($id);
    $server = $s->getServer($id);
    foreach ($server as $row) {
        $nomesv = $row['nome'];
        $idServer = $row['id'];
        $ip = $row['ip'];
        $porta = $row['porta'];
        $site = $row['site'];
        $votos = $row['votos'];
        $data = $row['dataRegistro'];
        $data = date_create($row['dataRegistro']);
    }
}

include("inc/header.php");

$query = new SampQuery($ip, $porta); // Create the SampQuery object

if ($query->connect()) { // Attempt to the SA-MP server and if the connection was successful run the code below
    $serverInfo = $query->getInfo();
    ?>

    <div class="container">
        <div class="col-md-12">

            <div class="col-md-7">
                <h1 style="text-align: center;">Status do Servidor</h1>
                <h4 style="text-align: center;">Veja agora as informações do servidor</h4><br>
            </div>
            <div class="col-md-3">
                <br>
                <a href="votar.php?server=<?= $idServer; ?>" class="right btn-lg btn-success">VOTAR NESSE SERVIDOR</a>
            </div>
        </div>
        <table class="tabela myserver table table-striped" style="width:700px;" align="center">
            <tr>
                <td><b>Hostname</b></td>
                <td><?= $serverInfo['hostname']; ?></td>
            </tr>
            <tr>
                <td><b>IP do Servidor</b></td>
                <td><a rel="nofollow" target="_blank" class="postlink" href="samp://<?= $ip . ':' . $porta; ?>"><?= $ip . ":" . $porta; ?></a></td>
            </tr>
            <tr>
                <td><b>Players</b></td>
                <td><?= $serverInfo['players'] . " / " . $serverInfo['maxplayers']; ?></td>
            </tr>
            <tr>
                <td><b>Total de Votos</b></td>
                <td><?= $votos; ?></td>
            </tr>
            <tr>
                <td><b>Gamemode</b></td>
                <td><?= $serverInfo['gamemode']; ?></td>
            </tr>
            <tr>
                <td><b>Map</b></td>
                <td><?= $serverInfo['map']; ?></td>
            </tr>
            <tr>
                <td><b>Site/Fórum</b></td>
                <td><a href="http://<?= $site; ?>" target="_blank"><?= $site; ?></a></td>
            </tr>
            <tr>
                <td><b>Registrado no Top SA-MP desde</b></td>
                <td><?= date_format($data, 'd/m/Y'); ?></td>
            </tr>
        </table>
        <?php
    } else {
        echo "<h1 align='center'><br><br>O servidor parece estar offline, tente novamente mais tarde...</h1>";
    }
    $query->close(); // Close the connection
    ?>
</div>