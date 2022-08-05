<?php ob_start(); ?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <!-- CSS only -->
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor' crossorigin='anonymous'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>

    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
    <link rel='stylesheet' href='../static/fontawesome-pro/css/all.css'>
    <link rel='stylesheet' href='//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <style>
        td{
            height: 32px;
            text-align: center;
        }

        .c {
        display: flex;
        flex-direction: column;
    }
    table.table.table-bordered.border.border-warning.stripped {
    border-color: rebeccapurple !important;
    
    }
    </style>
</head>
<body>


<?php
// conexão com o banco de dados
$con = mysqli_connect('localhost', 'root', '', 'dailyevent') or trigger_error(mysqli_error());
// armazena os dados da conexão numa variável
$leg_sql = mysqli_query($con, "select tipo_evento as tipo, desc_leg as descricao, simbolo_leg as simbolo, sigla_leg as sigla, cor_leg as cor from legenda ;");
$html .= "<table  style='width:40%; height:10%; border:3px solid'>";
while($row = mysqli_fetch_array($sql)){
    $html .= "<tr>";
    $html .= "<td style='border:2px solid; background-color:".$row['cor'].";'><i style='font-family:fontawesome;' class='fa ".$row['simbolo']."'></i>".$row['sigla']."</td>";
    $html .= "<td style='border:2px solid'>".$row['tipo']."</td>";
    $html .= "<td style='border:2px solid'>".$row['descricao']."</td>";

    $html .= "</tr>";
    }


$html .= "</table>";
