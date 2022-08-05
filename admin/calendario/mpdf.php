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
    'format' => 'A4',
    'orientation' => 'L'
]);
$mpdf->SetDisplayMode('fullwidth');
$mpdf->WriteHTML($_SESSION['html']);
$mpdf->Output();
?>