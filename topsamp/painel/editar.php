<?php
include("header.php");
if (!isset($_GET['id']) && !is_numeric($_GET['id'])) {
    header("Location: index.php");
}

$id = preg_replace("/[^0-9\s]/", "", $_GET['id']);
$s = new Servidor;
$server = $s->retornaServidor($id, $idDono);
foreach ($server as $row) {
    $server = $row['nome'];
    $ip = $row['ip'];
    $porta = $row['porta'];
    $site = $row['site'];
}

if(isset($_POST['nome']) && isset($_POST['ip']) && isset($_POST['porta']) && isset($_POST['site'])){
    $nome = preg_replace("/[^a-zA-Z0-9\ \-]/", "", $_POST['nome']);
    $ip = preg_replace  ("/[^a-zA-Z0-9\.\-]/", "", $_POST['ip']);
    $site = preg_replace("/[^a-zA-Z0-9\.\:\/\-]/", "", $_POST['site']);
    $porta = preg_replace("/[^0-9\s]/", "", $_POST['porta']);
    $s->alterarServidor($id, $nome, $ip, $porta, $site);
}

// Avisos
if (isset($_GET['editado']) && $_GET['editado'] == "true") {
    echo "<div class='container'><br>
            <div class='alert alert-success alert-dismissible' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Parabéns!</strong> Servidor editado com sucesso!
</div></div>";
}

include("menu.php");
?>

<div class="container">
    <div class="cold-m-12">
        <h1><i class='glyphicon glyphicon-cog'></i> Editar servidor</h1>
        <p>Faça as alterações necessárias nessa área!</p><br>
    </div>
    <div class="col-md-10">
        <fieldset>
            <legend>Informações</legend>
            <form method="POST" class="col-md-12 form-horizontal">
                <div class="form-group">
                    <label for="nome" class="col-sm-3 control-label">Nome do Servidor:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="nome" name="nome" value="<?= $server; ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="ip" class="col-sm-3 control-label">IP do Servidor:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="descricao" name="ip" value="<?= $ip; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="porta" class="col-sm-3 control-label">Porta:</label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" style="display: inline;" id="porta" name="porta" maxlength="6" value="<?= $porta; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="site" class="col-sm-3 control-label">Site/Fórum:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="site" name="site" value="<?= $site; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="right btn btn-success"><i class='glyphicon glyphicon-pencil'></i> SALVAR</button>
                    </div>
                </div>
            </form>
        </fieldset>
    </div>
</div>