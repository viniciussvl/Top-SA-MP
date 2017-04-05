a<?php
include("inc/config.php");
require_once("class/Servidor.class.php");

if (!isset($_GET['server']) && !is_numeric($_GET['server'])) {
    header("Location: index.php");
}

$v = new Servidor;
$servidor = preg_replace("/[^0-9\s]/", "", $_GET['server']);
$server = $v->getServer($servidor);
foreach ($server as $row) {
    $svname = $row['nome'];
}
$ip = $v->buscarIp();
$data = date('Y-m-d');

$verificaIpVoto = $v->consultaVotoIp($ip, $data, $servidor);
if ($verificaIpVoto) {
    header("Location: index.php?votou=true");
} else {
    if (isset($_POST['g-recaptcha-response'])) {
        $captcha_data = $_POST['g-recaptcha-response'];
        if (!$captcha_data) {
            echo "<script>alert('Confirme que você não é um robô');</script>";
        } else {
            $resposta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lfx5BEUAAAAALVaIK0cm0GpBLYWNTTEZNbAgEwu&response=" . $captcha_data . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
            if ($resposta . success) {
                $hora = date('H:i');
                $votar = $v->votar($ip, $data, $hora, $servidor);
                header("Location: index.php?votou=false");
            } else {
                echo "Usuário mal intencionado detectado. A mensagem não foi enviada.";
                exit;
            }
        }
    }
}


include("inc/header.php");
?>

<?php
if (!$verificaIpVoto):
    ?>
    <div class='container'>

        <div class='col-md-7 col-md-offset-2'>
            <p class='texto-info'><br>Você está votando no servidor <strong><?= $svname; ?></strong>, confirme que você não é um robô!</p>
            <form method="POST">
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
    </div>

    <?php
endif;
?>


