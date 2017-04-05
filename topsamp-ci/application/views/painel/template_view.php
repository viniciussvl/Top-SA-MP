<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Top SA-MP - Painel de Controle</title>
        <link rel="icon" href="<?= base_url('assets/img/favicon.png'); ?>" type="image/x-icon">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
        <link rel="stylesheet" href="<?= base_url('assets/css/estilo.css'); ?>">  
        <link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <script src="<?= base_url('assets/js/javascript.js'); ?>"></script>
    </head>
    <body>
        <div class="menu-painel">
            <sidebar class="menu-lateral">
                <div class="user">
                    <p>Olá <span><?= $this->session->userdata('usuarioLogado')['nome']; ?></span>!</p>
                </div>
                <div class="menu-navegacao">
                    <h2>Menu de Navegação</h2>
                </div>
                <div class="clearfix"></div>
                <a href="<?= base_url('painel'); ?>"><i class="glyphicon glyphicon-home"></i> Página Inicial</a>
                <a href="javascript:void(0);" data-toggle="modal" data-target="#novoServidor"><i class="glyphicon glyphicon-plus"></i> Adicionar servidor</a>
                <a href="#"><i class="glyphicon glyphicon-user"></i> Editar perfil</a>
                <a href="<?= base_url(''); ?>"><i class="glyphicon glyphicon-share-alt"></i> Voltar ao site</a>
                <a href="<?= base_url('deslogar'); ?>"><i class="glyphicon glyphicon-off"></i> Sair</a>
            </sidebar>
        </div>

        <div class="conteudo col-md-9">
            <br>
            <div class="col-md-12">
                <br>
                <?php if ($this->session->flashdata('existe')) { ?>

                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        Esse servidor já existe em nosso banco de dados!
                    </div>

                <?php } elseif ($this->session->flashdata('add')) { ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        Servidor adicionado com sucesso!
                    </div>
                <?php } elseif ($this->session->flashdata('deletado')) { ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        Servidor deletado com sucesso!
                    </div>
                <?php } ?>

                <?= $contents ?>
            </div> 


        </div>

        <!-- MODAL:  Novo servidor -->
        <div class="modal fade" id="novoServidor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Cadastrar um novo servidor</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="<?= base_url('Usuario/novoServidor'); ?>" class="form-horizontal">
                            <div class="form-group">
                                <label for="nome" class="col-sm-2 control-label">Nome</label>
                                <div class="col-sm-10">
                                    <input type="text" minlength="6" maxlength="32" class="form-control" id="nome" name="nome" placeholder="Exemplo: Brasil Vida Real [RPG]" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ip" class="col-sm-2 control-label">IP</label>
                                <div class="col-sm-10">
                                    <input type="text" minlength="12" maxlength="32" class="form-control" id="ip" name="ip" placeholder="IP sem Porta" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="porta" class="col-sm-2 control-label">Porta</label>
                                <div class="col-sm-10">
                                    <input type="text" minlength="3" maxlength="8" class="form-control" id="porta" name="porta" placeholder="Exemplo: 7777" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="site" class="col-sm-2 control-label">Site/Fórum</label>
                                <div class="col-sm-10">
                                    <input type="text" minlength="8" maxlength="40"  class="form-control" id="site" name="site" placeholder="Cole o link aqui, por exemplo http://www.topsamp.com.br" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="site" class="col-sm-2 control-label">Frase</label>
                                <div class="col-sm-10">
                                    <input type="text" minlength="10" maxlength="60"  class="form-control" id="frase" name="frase" placeholder="Exemplo: Somos um servidor de muita qualidade e disposição!" required>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary"><i class='glyphicon glyphicon-pencil'></i> Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- fim modal -->
    </body>
</html>