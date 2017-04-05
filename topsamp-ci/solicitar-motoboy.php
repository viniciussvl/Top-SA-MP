<?php include('includes/header.php') ?>

	<article id="geral">
		<div class="centraliza">
			<section id="bloco-esquerda">
				<h1>SOLICITE UM MOTOBOY</h1>
				
				<p>Utilize o formulário abaixo para solicitar um motoboy, preencha as informações corretamente pois iremos entrar em contato o mais rápido possível!</p>

				<form id="form-motoboy" method="POST" action="enviaSolicite.php">
					Endereço para coleta * <input type="text" id="personalizado" name="end-coleta" placeholder="Ex: Rua Francesco Pratella, 208 - Americanópolis">
					Endereço para entrega * <input type="text" id="personalizado" name="end-entrega" placeholder="Ex: Rua Pratella Francescp, 802 - Americanópolis">

					Volume/Tamanho da mercadoria *<br/>
					<label><input type="radio" name="tamanho" value="Pequeno" checked required>Pequeno</label><br/>
					<label><input type="radio" name="tamanho" value="Medio" required> Médio</label><br/>
					<label><input type="radio" name="tamanho" value="Grande" required> Grande</label><br/><br/>

					Nome * <input type="text" id="personalizado" name="nome">
					Telefone * <input type="text" id="personalizado" name="telefone">
					E-mail * <input type="email" id="personalizado" name="email">
					Informações adicionais * <textarea id="mensagem" name="mensagem" required></textarea><br>

					<input type="submit" name="enviar" class="solicite" value="SOLICITAR MOTOBOY"/> 
				</form>
			</section>

			<aside id="bloco-direita">
				<img src="img/motoboy2.png" alt="Motoboy de Vermelho">
				<ul>
					<h2>Nossos motoboys são preparados e aptos para realizar serviços de:</h2>
						<li>• Cartório;</li>
						<li>• Bancos;</li>
						<li>• Serviços Aeroportuários;</li>
						<li>• Retirada de documentos e exames;</li>
						<li>• Retirada de caixas pequenas;</li>
				</ul>
			</aside>
		</div>
	</article>

<?php include('includes/footer.php'); ?>