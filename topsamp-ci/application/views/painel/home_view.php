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
        foreach ($servidores as $v):
            if($this->server->getVotosHoje($v->id) > 0){
                $totVotosHoje = $this->server->getVotosHoje($v->id);
            } else{
                $totVotosHoje = 0;
            }
    ?>
        <tr>
            <td><?= $v->nome; ?></td>
            <td><?= $v->votos; ?></td>
            <td><?= $totVotosHoje; ?></td>
            <td><?= $v->cliques; ?></td>
            <td><?= $v->ip . ":" . $v->porta ?></td>
            <td><?= data($v->dataRegistro); ?></td>
            <td>
                <!-- Small button group -->
                <div class="btn-group">
                    <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Selecione <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="<?= base_url("painel/editar/{$v->id}"); ?>">Editar servidor</a></li>
                        <li><a href="<?= base_url("servidor/{$v->id}"); ?>" target='_blank'>Status do servidor</a></li>
                        <li><a onclick="return confirm('Deseja realmente excluir o servidor selecionado?');" href="<?= base_url("painel/deletar/{$v->id}"); ?>">Excluir servidor</a></li>
                        <li role="separator" class="divider"></li>
                    </ul>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
</table>