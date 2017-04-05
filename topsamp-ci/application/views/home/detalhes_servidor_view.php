<?php
require('application/libraries/SampQuery.php');
foreach ($detalhes as $v):
    $query = new SampQuery($v->ip, $v->porta);
    if ($query->connect()) {
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
                    <a href="<?= base_url("votar/{$v->id}"); ?>" class="right btn-lg btn-success">VOTAR NESSE SERVIDOR</a>
                </div>
            </div>
            <table class="tabela myserver table table-striped" style="width:700px;" align="center">
                <tr>
                    <td><b>Hostname</b></td>
                    <td><?= utf8_encode($serverInfo['hostname']); ?></td>
                </tr>
                <tr>
                    <td><b>IP do Servidor</b></td>
                    <td><a rel="nofollow" target="_blank" class="postlink" href="samp://<?= $v->ip . ':' . $v->porta; ?>"><?= $v->ip . ":" . $v->porta; ?></a></td>
                </tr>
                <tr>
                    <td><b>Players</b></td>
                    <td><?= $serverInfo['players'] . " / " . $serverInfo['maxplayers']; ?></td>
                </tr>
                <tr>
                    <td><b>Total de Votos</b></td>
                    <td><?= $v->votos; ?></td>
                </tr>
                <tr>
                    <td><b>Gamemode</b></td>
                    <td><?= utf8_encode($serverInfo['gamemode']); ?></td>
                </tr>
                <tr>
                    <td><b>Map</b></td>
                    <td><?= utf8_encode($serverInfo['map']); ?></td>
                </tr>
                <tr>
                    <td><b>Site/Fórum</b></td>
                    <td><a href="<?= $v->site; ?>" target="_blank"><?= $v->site; ?></a></td>
                </tr>
                <tr>
                    <td><b>Registrado no Top SA-MP desde</b></td>
                    <td><?= data($v->dataRegistro); ?></td>
                </tr>
            </table>
        </div>
        </tbody>
        </table>
        <?php
    } else {
        echo "Carregue novamente, sistema está lento...";
    }
    $query->close(); // Close the connection
endforeach;
?>