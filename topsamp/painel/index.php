<?php
include("header.php");
include("menu.php");
?>

<div class="conteudo col-md-9">
    <div class="col-md-12">
        <div class="col-md-12">
            <a title="Adicionar novo servidor" href="#" data-toggle="modal" data-target="#novoServidor" class="btn-new right"><i class='glyphicon glyphicon-plus'></i></a> 
        </div>
            <table class="tabela myserver table table-bordered table-striped">
                <tr>
                    <th>Nome</th>
                    <th>Total de Votos</th>
                    <th>Votos Hoje</th>
                    <th>Total de Cliques</th>
                    <th>IP do Servidor</th>
                    <th>Data de Registro</th>
                    <th>Ações</th>
                </tr>
                <?php
                require_once("../class/Servidor.class.php");
                $s = new Servidor;
                $servers = $s->listarServidores($idDono);
                foreach ($servers as $row):
                    $idServer = $row['id'];
                    $sv = $row['nome'];
                    $ip = $row['ip'];
                    $porta = $row['porta'];
                    $votos = $row['votos'];
                    $cliques = $row['cliques'];
                    $votosHoje = $s->getVotosHoje($idServer);
                    $data = date_create($row['dataRegistro']);
                    ?>
                    <tr>
                        <td><?= $sv; ?></td>
                        <td><?= $votos; ?></td>
                        <td><?= $votosHoje; ?></td>
                        <td><?= $cliques; ?></td>
                        <td><?= $ip . ":" . $porta; ?></td>
                        <td><?= date_format($data, 'd/m/Y'); ?></td>
                        <td>

                            <!-- Small button group -->
                            <div class="btn-group">
                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Selecione <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="editar.php?id=<?= $idServer; ?>">Editar servidor</a></li>
                                    <li><a target='_blank' href="http://topsamp.com.br/status.php?id=<?= $idServer; ?>">Status do servidor</a></li>
                                    <li><a href="index.php?excluir=<?= $idServer; ?>" onclick="return confirm('Deseja realmente excluir o servidor selecionado?')">Excluir servidor</a></li>
                                    <li role="separator" class="divider"></li>

                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php
                endforeach;
                ?>
            </table>
    </div> 
</div>




</body>
</html>