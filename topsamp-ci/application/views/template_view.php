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
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?= base_url('assets/img/favicon.png'); ?>" type="image/x-icon">
        <link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url('assets/css/estilo.css'); ?>">  
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
    <center>
        <img style="display:none; padding: 250px 0 400px;" class="carregando" src="<?= base_url('assets/img/loading.gif'); ?>"/>
    </center>
    <div class="barra-topo">
        <div class="container">
            <p class="left">Encontre os melhores servidores de SA-MP! - <?= $this->session->userdata('users') . ' pessoa(s) votando'; ?> </p>
            <p class="right area-cliente">
                <?php
                if (!$this->session->userdata('usuarioLogado')) {
                    ?>
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modalLogin">Entrar</a>
                    <a href="<?= base_url('registrar'); ?>">Registrar</a>
                <?php } else { ?>
                    <a href="<?= base_url('painel'); ?>"><i class='glyphicon glyphicon-cog'></i> Painel de Controle</a>
                    <a href="<?= base_url('deslogar'); ?>">Sair</a>
                <?php } ?>
        </div>
    </p>
</div>
<header id="topo">
    <nav class="menu navbar navbar-default col-md-12">
        <div class="container">
            <div class="col-md-6 logo">
                <a class="navbar-brand" href="<?= base_url(''); ?>">
                    <img src="<?= base_url('assets/img/logo.png'); ?>" alt="Top SA-MP - Encontre os melhores servidores de SA-MP!" width="270" title="Top SA-MP - Encontre os melhores servidores de SAMP!">
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
                    <li><a href="<?= base_url(''); ?>">PÁGINA INICIAL</a></li>
                    <li><a href="<?= base_url('sobre'); ?>">QUEM SOMOS</a></li>
                    <li><a href="<?= base_url('projeto'); ?>">PROJETO</a></li>
                    <li><a href="<?= base_url('contato'); ?>">CONTATO</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>
</header>

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

    <?= $contents ?> 
</div>

<!-- MODAL DE LOGIN -->
<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Faça o login</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('logar'); ?>" class="form-horizontal">
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email :</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" maxlength="32" id="email" name="email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="senha" class="col-sm-2 control-label">Senha :</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="senha" maxlength="32" name="senha" placeholder="Senha" required>
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

<footer id="rodape">
    <div class="centraliza">
        <div id="copyright">
            <p class="copy">Top SA-MP © 2017 - Todos os direitos reservados</p>
            <ul>
                <p class="copy">Sugestões, dúvidas, críticas? Skype: svlvinicius</p>
            </ul>
        </div>
        <div class="">
            <div class="container">
                <a href="<?= base_url('politica-privacidade'); ?>">Política de Privacidade</a>
            </div>
        </div>
    </div>
</footer>

<script>
            path = "<?= base_url(''); ?>";
            ip = "<?= buscarIp(); ?>";
            dataAtual = "<?= date('Y-m-d'); ?>";
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/javascript.js'); ?>"></script>
</body>
</html>