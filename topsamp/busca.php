<?php
require_once("class/Servidor.class.php");
require_once("class/Paginacao.class.php");

if (!isset($_GET['p'])) {
    header("Location: index.php");
} else {
    include("inc/header.php");
    $busca = preg_replace("/[^a-zA-Z0-9]/", "", $_GET['p']);
}
$p = new Servidor;
$servidores = $p->getBusca($busca);
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            if ($servidores == true) {
            echo "<h3>Resultados encontrados para <strong>$busca</strong></h3><br>";
            } 
        ?>
        </div>
        <div class="col-md-12">
            <p></p>
        </div>
        <div class="col-md-9">
            <?php
            if ($servidores == false) {
                echo "<h3>Não conseguimos encontrar nada com <strong>$busca</strong></h3>";
            } else {
                ?>
                <fieldset>
                    <legend>Resultados encontrados</legend>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Servidor</th>
                                <th class="radius-right">Votos</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            foreach ($servidores as $i => $row):
                                $idServer = $row['id'];
                                $nome = $row['nome'];
                                $ip = $row['ip'];
                                $porta = $row['porta'];
                                $votos = $row['votos'];
                                $site = $row['site'];
                                ?>
                                <tr>
                                
                                <td>
                                    <span class='nome-server'>
                                        <a title="Mais informações sobre <?= $nome; ?>" href="status.php?id=<?= $idServer; ?>"><?= $nome; ?></a> <?php
                                        $query = new SampQuery($ip, $porta);
                                        if ($query->connect()) {
                                            echo "<img title='Online' src='assets/img/on.png' width='8'></span>";
                                            $serverInfo = $query->getInfo();
                                            echo "<span class='players'><span style='padding-right: 11px;'>Players:</span> " . $serverInfo['players'] . " / " . $serverInfo['maxplayers'];
                                        } else {
                                            echo "<img title='Offline' src='assets/img/off.png' width='8'></span>";
                                            echo "<span class='players'>Server offline</span>";
                                        }
                                        $query->close(); // Close the connection
                                        
                                ?>
                                        
                                    
                                    <p class='info-server'>
                                        <span class='ip-server'><?= $ip . ':' . $porta; ?> </span>
                                        <span class='separador'>|</span>
                                        <a class="site" href="<?= $site; ?>" target="_blank"><?= $site; ?></a>
                                    </p>

                                </td>
                                <td>
                                    <span class='votos'><?= $votos; ?></span>
                                    <a href="votar.php?server=<?= $idServer; ?>" class="btn btn-success">VOTAR</a>
                                </td>
                            <?php endforeach; ?>
                        </tr>

                        </tbody>            
                    </table>
                </fieldset>
                <?php
            }
            ?>

        </div>

        <?php include("inc/widgets.php"); ?>
    </div>

</div>