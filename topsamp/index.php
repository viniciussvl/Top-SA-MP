<?php

require_once("class/Paginacao.class.php");
// Paginação
if (isset($_GET['pagina']) && !is_numeric($_GET['pagina'])) {
    header("Location: index.php");
}
$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
if (isset($_GET['pagina']) && $_GET['pagina'] <= 0 || !is_numeric($_GET['pagina'])) {
    header("Location: index.php?pagina=1");
}
$p = new Paginacao;
$p->sql = "SELECT * FROM servidor";
$p->getRegistros();
$p->calcularRegistros(50, $pagina);
$servidores = $p->getResultados();
$numPaginas = $p->getNumPaginas();
$inicio = $p->getInicio();
if ($pagina > $numPaginas || $pagina <= 0) {
    header("Location: index.php?pagina=1");
}
include("inc/header.php");
?>


<div class="container">
    <!-- ANUNCIO -->
    <div align="center" style="margin-top: 10px;">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- tamanho banner -->
        <ins class="adsbygoogle"
             style="display:inline-block;width:728px;height:90px"
             data-ad-client="ca-pub-3634927973539996"
             data-ad-slot="1180587067"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($_GET['votou'])) {
                if ($_GET['votou'] == "false") {
                    $cor = 'success';
                    $msg = "Seu voto foi registrado com sucesso, você poderá votar novamente às 00:00!";
                } else {
                    $cor = 'danger';
                    $msg = "Você já votou hoje, poderá votar novamente às 00:00!";
                }
                echo "<br><div class='alert alert-{$cor} alert-dismissible' role='alert'>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  $msg
</div>";
            }
            ?>
            <h3>Encontre os melhores servidores de San Andreas Multiplayer!</h3><br>
            <div class="col-md-2" style="padding: 0; margin: 5px 0;">

                <!-- <form method="POST" action="validacao.php">
                    <select class="form-control">
                        <option>Mais votados</option>
                        <option>Menos votados</option>
                    </select>
                </form> -->
            </div>
            <?php include("inc/paginacao.php"); ?>
        </div>
        <div class="col-md-12">
            <p></p>
        </div>
        <div class="col-md-9">

            <fieldset>
                <legend>Ranking de Servidores</legend>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="radius-left">Ranking</th>
                            <th>Servidor</th>
                            <th class="radius-right">Votos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($servidores as $i => $row):
                            $idServer = $row['id'];
                            $nome = utf8_encode($row['nome']);
                            $ip = $row['ip'];
                            $porta = $row['porta'];
                            $votos = $row['votos'];
                            $site = $row['site'];
                            ?>
                            <tr>
                                <td><span class='ranking'><?= $i + 1 + $inicio; ?></span></td>
                                <td>
                                    <span class='nome-server'>
                                        <a title="Mais informações sobre <?= $nome; ?>" href="status.php?id=<?= $idServer; ?>"><?= $nome; ?></a> <?php
                                        /* $query = new SampQuery($ip, $porta);
                                        if ($query->connect()) {
                                            echo "<img title='Online' src='assets/img/on.png' width='8'></span>";
                                            $serverInfo = $query->getInfo();
                                            echo "<span class='players'><span style='padding-right: 11px;'>Players:</span> " . $serverInfo['players'] . " / " . $serverInfo['maxplayers'];
                                        } else {
                                            echo "<img title='Offline' src='assets/img/off.png' width='8'></span>";
                                            echo "<span class='players'>Server offline</span>";
                                        }
                                        $query->close(); // Close the connection */
                                        ?>


                                        <p class='info-server'>
                                            <span class='ip-server'><?= $ip . ':' . $porta; ?> </span>
                                            <span class='separador'>|</span>
                                            <a class="site" href="<?= $site; ?>" target="_blank"><?= $site; ?></a>
                                        </p>

                                </td>
                                <td>
                                    <span class='votos'><?= $votos; ?></span>
                                    <a href="votar.php?server=<?= $idServer; ?>" class="btn btn-vote">VOTAR</a>
                                </td>
                            <?php endforeach; ?>
                        </tr>

                    </tbody>            
                </table>
            </fieldset>
        </div>

        <?php include("inc/widgets.php"); ?>

    </div>
    <div class="col-md-7 right">
        <?php include("inc/paginacao.php"); ?>
    </div>
</div>
</div>

<?php
include("inc/footer.php");
?>