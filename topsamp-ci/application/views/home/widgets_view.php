
    <?php
    if (!isset($_SESSION['usuarioLogado'])) {
        ?>
        <fieldset>
            <legend>Cadastrar servidor</legend>
            <p>Cadastre seu servidor para que ele possa aparecer no ranking!</p>
            <a href="#" data-toggle="modal" data-target="#modalNew" class="btn btn-primary">Cadastrar servidor</a>
        </fieldset>

    <?php } else {
        ?>
        <fieldset>
            <legend>Painel de Controle</legend>
            <p class="texto-info">Acesse o seu painel de controle a qualquer momento clicando no botão abaixo!</p>
            <a href="<?= base_url('painel'); ?>" class="btn btn-primary">Painel de Controle</a>
        </fieldset>

        <?php
    }
    ?>




    <fieldset>
        <legend>Procurar um servidor</legend>
        <form method="POST" class="form-inline">
            <div class="form-group">
                <label class="sr-only" for="busca">...</label>
                <input type="text" class="form-control" id="busca" name="p" placeholder="Nome do servidor" required>
            </div>
            <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
        </form>
    </fieldset>

    <fieldset>
        <legend>Sobre nós</legend>
        <p class="texto-info"><br><br><strong>Top SA-MP</strong> é uma comunidade brasileira onde lista os melhores servidores de SA-MP atualmente. Ele conta com um sistema de votação onde os próprios jogadores podem votar diariamente no seu servidor favorito, dando mais visibilidade e divulgação para o mesmo. </p>

    </fieldset>

    <!-- ANUNCIO -->
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- Tamanho automatico -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-3634927973539996"
         data-ad-slot="8564253062"
         data-ad-format="auto"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>


    <!-- Modal -->
    <div class="modal fade" id="modalNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Cadastre seu servidor</h4>
                </div>
                <div class="modal-body">
                    <p class="texto-info">Para cadastrar o seu servidor no Top SA-MP é necessário estar registrado e logado</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <a href="<?= base_url('registrar'); ?>" class="btn btn-primary">Registrar</a>
                </div>
            </div>
        </div>
    </div>
</div>