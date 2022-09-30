<?php
if(!isset($_SESSION)) session_start();
require_once __DIR__ . '/vendor/autoload.php';

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];
$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/../../resources/fonts',
    ]),
    'fontdata' => $fontData + [
        'fontawesome' => [
            'R' => 'fa-solid-900.ttf'
        ],
    ],
    'format' => 'A3',
    'orientation' => 'L',
    'margin_left' => 0, 
    'margin_right' => 0, 
    'margin_top' => 0, 
    'margin_bottom' => 0, 
    'margin_header' => 0, 
    'margin_footer' => 0,
]);
$mpdf->SetDisplayMode('fullwidth');

$doc = new DOMDocument();
$doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
$html= $this->checkLargeTables($doc);

$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($_SESSION['html'],2);
$mpdf->Output();
?>
<body>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js' integrity='sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2' crossorigin='anonymous'></script>
</body>