<div class="spc">
    <?php if ($this->session->flashdata('erro')) { ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Essa conta já existe em nosso banco de dados!
        </div>

    <?php } elseif ($this->session->flashdata('sucesso')) { ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Conta cadastrada com sucesso, agora você pode efetuar o login!
        </div>
    <?php } ?>
    
    <div class="col-md-5">
        <p class='texto-info'>Para cadastrar seu servidor no Top SA-MP é necessário criar uma conta, é rápido e levará apenas alguns segundos.<br>
        </p>
        <form method="POST" action="<?= base_url('registrar'); ?>">
            <div class="form-group">
                <label for="nome">Nome completo:</label>
                <input type="text" minlength="10" maxlength="50" class="form-control" id="nome" name="nome" placeholder="Informe seu nome" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" maxlength="32" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" minlength="5" maxlength="50" class="form-control" id="senha" name="senha" placeholder="Senha" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
    <div class="col-md-6 col-md-offset-1">
        <fieldset>
            <legend>O Projeto</legend>
            <p class='texto-info'>Top SA-MP é uma comunidade brasileira onde lista os melhores servidores de SA-MP atualmente. Ele conta com um sistema de votação onde os próprios jogadores podem votar diariamente no seu servidor preferido, dando mais visibilidade e divulgação para o mesmo. <br><br>O objetivo do Top SA-MP é divulgar os servidores brasileiros gratuitamente, contando apenas com o voto de vocês todos os dias!</p>
        </fieldset>
    </div>
</div>