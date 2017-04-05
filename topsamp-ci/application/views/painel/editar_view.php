<?php
foreach($servidores as $v):
?>

<div class="cold-m-12">
        <h1><i class='glyphicon glyphicon-cog'></i> Editar servidor</h1>
        <p>Faça as alterações necessárias nessa área!</p><br>
    </div>
    <div class="col-md-10">
       
            <form method="POST" action="<?= base_url('Usuario/alterarServidor'); ?>" class="col-md-12 form-horizontal">
                <input type="hidden" class="form-control" id="idServer" name="idServer" value="<?= $v->id; ?>">
                <div class="form-group">
                    <label for="nome" class="col-sm-3 control-label">Nome do Servidor:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="nome" maxlength="70" minlength="5" name="nome" value="<?= $v->nome; ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="ip" class="col-sm-3 control-label">IP do Servidor:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" maxlength="70" minlength="5" id="descricao" name="ip" value="<?= $v->ip; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="porta" class="col-sm-3 control-label">Porta:</label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" style="display: inline;" id="porta" name="porta" maxlength="6" value="<?= $v->porta; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="site" class="col-sm-3 control-label">Site/Fórum:</label>
                    <div class="col-sm-6">
                        <input type="text" maxlength="50" minlength="6" class="form-control" id="site" name="site" value="<?= $v->site; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="site" class="col-sm-3 control-label">Frase:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" minlength="20" maxlength="70" id="frase" name="frase" value="<?= $v->frase; ?>" required>
                    </div>
                </div>                
                
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="right btn btn-success"><i class='glyphicon glyphicon-pencil'></i> SALVAR</button>
                    </div>
                </div>
            </form>
    </div>

<?php
endforeach;