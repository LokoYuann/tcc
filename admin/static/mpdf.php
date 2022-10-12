<?php
if(!isset($_SESSION)) session_start();
require_once __DIR__ . '/vendor/autoload.php';

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$cabecalho = "<div style='float: left;;width:70px;'>";
$cabecalho .= "<img src='/admin/static/img/faeteclogo.png' style='width:70px;'/>";
$cabecalho .= "</div>";
$cabecalho .= "<div style='font-size:12px;position: absolute; left:35%;float: left;text-align: center;'>";
$cabecalho .= "GOVERNO DO ESTADO DO RIO DE JANEIRO<br>";
$cabecalho .= "SECRETARIA DE ESTADO DE CIÊNCIA,TECNOLOGIA E INOVAÇÃO<br>";
$cabecalho .= "FUNDAÇÃO DE APOIO À ESCOLA TÉCNICA<br>";
$cabecalho .= mb_strtoupper($_SESSION['ue'])."<br><br>";
$cabecalho .= "<strong>CALENDÁRIO ESCOLAR - ".$_SESSION['ano']."<br>";
$cabecalho .= "EDUCAÇAO PROFISSIONAL TÉCNICA DE NÍVEL MÉDIO INTEGRADO</strong>";
$cabecalho .= "</div>";
$cabecalho .= "<div style='text-align: right; float: left;position: absolute; right:0%;'>";
if($_SESSION['logo_ue']){
$cabecalho .= "<img src='".$_SESSION['logo_ue']."' style='width:80px;'/>";}
$cabecalho .= "</div>";


$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];
$stylesheet = file_get_contents('https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css');
$stylesheet .= file_get_contents('/fontawesome-pro/css/all.css');
$stylesheet .= file_get_contents('https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
$stylesheet .= file_get_contents('css/main.css');
$stylesheet .= file_get_contents('css/mpdf.css');
$stylesheet .= file_get_contents('maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css');
$stylesheet .= file_get_contents('https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
$mpdf = new \Mpdf\Mpdf([
    'margin_top' => 4,
    'margin_bottom' => 4,
    'margin_right' => 4,
    'margin_left' => 4,
    'format' => 'A4',
    'orientation' => 'L'
]);
$mpdf->SetDisplayMode('fullwidth');


$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($cabecalho,2);
$mpdf->WriteHTML($_SESSION['calendario'],2);
if(!empty($_SESSION['legenda'])){
$mpdf->WriteHTML($_SESSION['legenda'],2);}
$mpdf->Output();
?>
<body>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js' integrity='sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2' crossorigin='anonymous'></script>
</body>