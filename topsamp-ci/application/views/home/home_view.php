<?php require('application/libraries/SampQuery.php');
?>

<div class="col-md-12">
    <?php if ($this->session->flashdata('erro')) { ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Você já votou hoje, poderá votar novamente às <strong>00:00</strong>!
        </div>

    <?php } elseif ($this->session->flashdata('sucesso')) { ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Seu voto foi computado com sucesso, poderá votar novamente às <strong>00:00</strong>!
        </div>
    <?php } ?>
        <h3>Encontre os melhores servidores de San Andreas Multiplayer!</h3>
    <br>
    <div class="col-md-9 paginacao">
        <?= $pagination; ?>
    </div>
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
                foreach ($servidores as $k => $row):


                    $frase = (empty($row->frase)) ? 'O dono do servidor não definiu uma frase!' : $row->frase;
                    ?>
                    <tr>
                        <td><span class='ranking'><?= $k + 1 + $offset; ?></span></td>
                        <td>
                            <a class="title-sv blue-tooltip" href="<?= base_url("servidor/{$row->id}"); ?>" data-toggle="tooltip"  data-placement="bottom" title="<?= $frase; ?>"><?= $row->nome; ?></a>
                            <?php
                            /* $query = new SampQuery($row->ip, $row->porta);
                              if ($query->connect()) { ?>
                              <img title="Online" class="img-status" src="<?= base_url(''); ?>assets/img/on.png" width="8">
                              <?php
                              $serverInfo = $query->getInfo();
                              echo "<span class='players'><span style='padding-right: 11px;'>Players:</span> " . $serverInfo['players'] . " / " . $serverInfo['maxplayers'];
                              } else { ?>
                              <img title='Offline' class='img-status' src="<?= base_url(''); ?>assets/img/off.png" width='8'>                  <?php
                              echo "<span class='players'>Server offline</span>";
                              }
                              $query->close(); // Close the connection */
                            ?>


                            <p class='info-server'>
                                <span class='ip-server'><?= $row->ip . ':' . $row->porta ?></span>
                                <span class='separador'>|</span>
                                <a class="site" href="<?= $row->site; ?>" target="_blank"><?= $row->site; ?></a>
                            </p>
                        </td>
                        <td>
                            <span class='votos' id='<?= $row->slug; ?>'><?= $row->votos; ?></span>
                            <a href="<?= base_url("votar/{$row->id}"); ?>" class="btn btn-vote">VOTAR</a>
                            <!-- <button value='<?= $row->slug; ?>' class="btn btn-vote">VOTAR</button> -->
                        </td>
                    <?php endforeach; ?>
                </tr>
            </tbody>            
        </table>
    </fieldset>
    <p class="texto-info">Está procurando algum servidor para jogar? O Top SA-MP é o lugar certo para você encontrar, veja os servidores mais votados na página inicial e escolha o que mais se encaixa para você. Nosso sistema tem novas funcionalidades, contando com um painel de controle onde você poderá analisar as estatísticas do seu servidor, quantos acessos ele teve, quantos votos teve no dia, etc...</p>
</div>

<?php $this->load->view('home/widgets_view'); ?>

<div class="col-md-9 paginacao">
    <?= $pagination; ?>
</div>