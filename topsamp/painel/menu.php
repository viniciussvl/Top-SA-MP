<div class="menu-painel">
    <sidebar class="menu-lateral">
        <div class="user">
            <p>Olá <span><?= $nome; ?></span>!</p>
        </div>
        <div class="menu-navegacao">
            <h2>Menu de Navegação</h2>
        </div>
        <div class="clearfix"></div>
        <a href="index.php"><i class="glyphicon glyphicon-home"></i> Página Inicial</a>
        <a href="javascript:void(0);" data-toggle="modal" data-target="#novoServidor"><i class="glyphicon glyphicon-plus"></i> Adicionar servidor</a>
        <a href="#"><i class="glyphicon glyphicon-user"></i> Editar perfil</a>
        <a href="../index.php"><i class="glyphicon glyphicon-share-alt"></i> Voltar ao site</a>
        <a href="index.php?sair=true"><i class="glyphicon glyphicon-off"></i> Sair</a>
    </sidebar>
</div>