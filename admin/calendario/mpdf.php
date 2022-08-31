<?php
if(!isset($_SESSION)) session_start();
require_once __DIR__ . '/vendor/autoload.php';

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];
$stylesheet = file_get_contents('https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css');
$stylesheet .= file_get_contents('../static/fontawesome-pro/css/all.css');
$stylesheet .= file_get_contents('//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
$stylesheet .= file_get_contents('css/main.css');
$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/../../resources/fonts',
    ]),
    'fontdata' => $fontData + [
        'fontawesome' => [
            'R' => 'fa-solid-900.ttf'
        ],
    ],
    'format' => 'A4',
    'orientation' => 'L'
]);
$mpdf->SetDisplayMode('fullwidth');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($_SESSION['html'],2);
$mpdf->Output();
?>
<body>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js' integrity='sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2' crossorigin='anonymous'></script>
</body>