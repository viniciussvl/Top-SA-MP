<?php foreach ($servidor as $v): ?> 
    <div class='col-md-7 col-md-offset-2'>
        <?php if ($this->session->flashdata('erro')) { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Por favor, confirme que você não é um robô!
            </div>
        <?php } ?>

        <p class='texto-info'><br>Você está votando no servidor <strong><?= $v->nome; ?></strong>, confirme que você não é um robô!</p>
        <form method="POST" action="<?= base_url("Home/confirmarVoto/{$v->id}"); ?>">
            <div class="g-recaptcha" data-sitekey="6Lfx5BEUAAAAAJEp9Pf_xwQLD7846KipkZ_dzuiH"></div>
            <input type="submit" value="VOTAR" class='btn-lg btn-success btn-votar' name="formulario">
        </form>
    </div>
    <div class="col-md-3">
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
    </div>
<?php endforeach; ?>