<?php
$ativar = false; // true para ativar...
if ($ativar) {
    echo "<h1>Site em manutenção</h1>";
    echo "<p>Voltamos logo, dentro de algumas horas você já poderá votar!";
    die;
}
include("config.php");
require("class/SampQuery.class.php"); // Require or include the SampQuery class file
require_once("class/Usuario.class.php");
require_once("class/Servidor.class.php");




session_start();

if (isset($_GET['sair']) && $_GET['sair'] == "true") {
    session_destroy();
    header("Location: index.php");
}

if (isset($_POST['emailLogin']) && isset($_POST['senhaLogin'])) {
    $email = preg_replace("/[^a-zA-Z0-9\.\@]/", "", $_POST['emailLogin']);
    $senha = preg_replace("/[^a-zA-Z0-9]/", "", $_POST['senhaLogin']);
    $u = new Usuario;
    $u->logar($email, $senha);
}

if (isset($_GET['erro']) && $_GET['erro'] == "dados") {
    echo "<script>alert('E-mail ou senha incorretos!');</script>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Top SA-MP - Encontre os melhores servidores!</title>
        <meta charset="UTF-8">
        <meta name="author" content="Vinicius Aquino">
        <meta name="keywords" content="SAMP, Servidor de SAMP, MTA DayZ, GTA San Andreas, GTA Online, Melhor servidor samp">
        <meta name="description" content="Top SA-MP é uma comunidade brasileira onde lista os melhores servidores de SA-MP atualmente. Ele conta com um sistema de votação onde os próprios jogadores podem votar diariamente no seu servidor preferido, dando mais visibilidade e divulgação para o mesmo.">
        <meta name="abstract" content="SAMP, Servidor de SAMP, MTA DayZ, GTA San Andreas, GTA Online, Melhor servidor samp">
        <meta property="og:title" content="Top SA-MP">
        <meta property="og:description" content="Top SA-MP é uma comunidade brasileira onde lista os melhores servidores de SA-MP atualmente. Ele conta com um sistema de votação onde os próprios jogadores podem votar diariamente no seu servidor preferido, dando mais visibilidade e divulgação para o mesmo.">
        <meta http-equiv=”Content-Language” content=”pt-br”>
        <meta name="rating" CONTENT="general">
        <meta name=”GOOGLEBOT” content=”index, follow”>
              <meta name=”AUDIENCE” content=”all”>
        <meta name="DISTRIBUTION" CONTENT="global">
        <meta name="LANGUAGE" CONTENT="PT">
        <meta name="robots" content="index, follow">
        <meta name="copyright" content="Top SA-MP - Todos os direitos reservados © 2017">
        <!--<meta name="viewport" content="width=device-width, initial-scale=1"> -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/css.css">
        <link rel="icon" href="assets/img/favicon.png" type="image/x-icon">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/estilo.css">  
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <!-- Anuncio -->
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-3634927973539996",
            enable_page_level_ads: true
          });
        </script>
    </head>
    <body>
        <div class="barra-topo">
            <div class="container">
                <p class="left">Encontre os melhores servidores de SA-MP - 
	                <?php
	                	$c = new Servidor;
						$users = $c->getUsuariosOnline();
	                	//if(isset($_SESSION['usuarioLogado']) && $_SESSION['usuarioLogado'] == "viniciussvl@hotmail.com"){
	                		//if($users){
	                			echo $users . " pessoa(s) votando";
	                		//}
						//}	?>
				</p>
				
                <p class="right area-cliente">
                    <?php
                    if (!isset($_SESSION['usuarioLogado'])) {
                        ?>
                   <a href="#" data-toggle="modal" data-target="#modalLogin">Entrar</a>
                    <a href="registrar.php">Registrar</a>
                    <?php
                } else {
                    echo "<a href='painel/index.php'><i class='glyphicon glyphicon-cog'></i> Painel de Controle</a>";
                    echo "<a href='index.php?sair=true'>Sair</a>";
                }
                ?>
            </div>
        </p>
    </div>
    <header id="topo">
        <nav class="menu navbar navbar-default col-md-12">
            <div class="container">
                <div class="col-md-6 logo">
                    <a class="navbar-brand" href="index.php">
                        <img src="assets/img/logo.png" alt="Top SA-MP - Encontre os melhores servidores de SA-MP!" width="270" title="Top SA-MP - Encontre os melhores servidores de SAMP!">
                    </a>
                </div>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse menu-responsivo" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">PÁGINA INICIAL</a></li>
                        <li><a href="sobre.php">QUEM SOMOS</a></li>
                        <li><a href="#">PROJETO</a></li>
                        <li><a href="#">CONTATO</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </nav>
    </header>

    <!-- Modal -->
    <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Faça o login</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" class="form-horizontal">
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email :</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" maxlength="32" id="email" name="emailLogin" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="senha" class="col-sm-2 control-label">Senha :</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="senha" maxlength="32" name="senhaLogin" placeholder="Senha" required>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
