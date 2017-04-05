<?php
/*if (isset($_POST['email'])) {
    require_once("class/Usuario.class.php");
    $email = $_POST['email'];
    $u = new Usuario;
    $usuario = $u->recuperarSenha($email);
}*/
?>

<form method="post">
    <label for="email">E-mail:</label>
    <input type="text" name="email" id="email">
    <input type="submit" value="Recuperar">
</form>