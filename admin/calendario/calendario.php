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
    table{
        
    }
    </style>
</head>
<body>


<?php
// conexão com o banco de dados
$con = mysqli_connect('localhost', 'root', '', 'dailyevent') or trigger_error(mysqli_error());
// armazena os dados da conexão numa variável
$sql = mysqli_query($con, "select * from eventos ;");
// cria outra conexão com o banco de dados, onde ele chama os dados com nomes mais fáceis para fazer o X e o Y da tabela
$daysql = mysqli_query($con, "select id_leg, EXTRACT(DAY FROM dt_ini_ev) AS d_ini, EXTRACT(DAY FROM dt_fim_ev) AS d_fim, EXTRACT(MONTH FROM dt_ini_ev) AS m_ini, EXTRACT(MONTH FROM dt_fim_ev) AS m_fim from eventos order by dt_ini_ev ;");
// armazena dias invalidos
$invday = mysqli_query($con, "with recursive date_ranges AS (SELECT '2022-01-01' dt UNION ALL SELECT dt + INTERVAL 1 DAY FROM date_ranges WHERE dt + INTERVAL 1 DAY <= '2022-12-31') SELECT  EXTRACT(DAY FROM dt) AS d_eve_inv, EXTRACT(MONTH FROM dt) AS m_eve_inv, EXTRACT(DAY FROM LAST_DAY(dt)) AS fim_mes FROM date_ranges WHERE DAYNAME(dt) = 'Sunday';");

$simb = array();
$eve = array();
while($row = mysqli_fetch_array($daysql)){
        $m_ini = $row['m_ini'];
        $d_ini = $row['d_ini'];
        $m_fim = $row['m_fim'];
        $d_fim = $row['d_fim'];
        $info_leg = mysqli_query($con, "select * from legenda where id_leg = ".$row['id_leg'].";");
        $leg = mysqli_fetch_array($info_leg);
        if ($d_ini <= $d_fim && $m_ini == $m_fim) {
            for ($d_ini; $d_ini < $d_fim; $d_ini++) {
                $eve[$m_ini][$d_ini] = "background-color:".$leg['cor_leg'].";";
                $simb[$m_ini][$d_ini] = "<i style='font-family:fontawesome;' class='fa ".$leg['simbolo_leg']."'></i>";
            }
        }
        else{
            if ($d_ini >= $d_fim && $m_ini < $m_fim) {
            if ($d_ini <= 32) {
                $eve[$m_ini][$d_ini] = "background-color:".$leg['cor_leg'].";";
                $simb[$m_ini][$d_ini] = "<i style='font-family:fontawesome;' class='fa ".$leg['simbolo_leg']."'></i>";
                $d_ini++;
                // se o mes inicial for menor ou igual ao mes final e o dia final for 32(máximo), reinicia o valor do dia inicial para um, voltando ao loop acima, e aumenta em um o valor do mes inicial, até satisfazer o mes inicial

                for ($d_fim; $d_fim >= 1; $d_fim--) {
                        $eve[$m_fim][$d_fim] = "background-color:".$leg['cor_leg'].";";
                        $simb[$m_fim][$d_fim] = "<i style='font-family:fontawesome;' class='fa fa-solid ".$leg['simbolo_leg']."'>&#Xf004</i>";
                    }
                } else {
                    $eve[$m_ini][$d_ini] = "background-color:".$leg['cor_leg'].";";
                    $simb[$m_ini][$d_ini] = "<i style='font-family:fontawesome;' class='fa ".$leg['simbolo_leg']."'></i>";


            }
        // se os meses e os dias não estiverem naquela condição, imprime um class vazio
        }
            for ($d_ini; $d_ini < 32; $d_ini++) {
                $eve[$m_ini][$d_ini] = "background-color:".$leg['cor_leg'].";";
                $simb[$m_ini][$d_ini] = "<i style='font-family:fontawesome;' class='fa ".$leg['simbolo_leg']."'></i>";

            }

        }



        $eve[$m_fim][$d_fim] = "background-color:".$leg['cor_leg'].";";
        $simb[$m_fim][$d_fim] = "<i style='font-family:fontawesome;' class='fa ".$leg['simbolo_leg']."'></i>";
    }

    while($row = mysqli_fetch_array($invday)){
        $domingo_d = $row[0];
        $domingo_m = $row[1];
        
       for ($i=$row[2]+1; $i <= 31; $i++) { 
        $eve[$domingo_m][$i] = "background-color:rgb(190, 190, 190); ";;
        $simb[$domingo_m][$i] = "";
    }

       $eve[$domingo_m][$domingo_d] = "";;
       $simb[$domingo_m][$domingo_d] = "<a>D</a>";
    }

$html = "<div style='text-align: -webkit-center;'>";

    // começo do calendário
    $html .= "<table  style='width:80%; height:50%; border:3px solid'>";
    $html .= "<tr >";
    $html .= "<td  rowspan='2' style='border:2px solid'>Meses</td>";
    $html .= "<td colspan='31' >Dias</td>";
    $html .= "<tr style='border-bottom:2px solid'>";
    for ($ç=1; $ç < 32; $ç++) {
        $html .= "<td colspan='ç'>$ç</td>";
    }
    $html .= "</tr>";
    $html .= "</tr>";

// começa a criar colunas de meses
for ($i=1; $i < 13; $i++) {
    // abre a linha dos meses
    $html .= "<tr class='cils' style='width:100%;'>";
    // abre a coluna dos meses
    $html .= "<td class='mis' style='width:10%;border-right:2px solid'>";

    // cria um array para armazenar os meses, o primeiro fica vazio pois dá erro na criação do calendário
    $meses = array("","Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");

    // usa o array, para cada valor ele usa o número da coluna para acessar um valor do array
    foreach ($meses as $a => $value) {
        $html .= "<span style='display:flex; justify-content:center;'><strong>".$meses[$i]."</strong></span>";
        break;
    }
    // fecha a linha de meses
    $html .= "</td>";

    // tentativa fracassada de repetir o argumento do if else
        // while ($coords = mysqli_fetch_array($daysql)) {

    // começo do argumento
    // enquanto tiver valores no banco de dados, ele imprime o argumento || geralmente cria um ou outro mas me confundi e deixei assim

        // começo da repetição dos dias $j
        for ($j=1; $j < 32; $j++) {
            $html .= "<td style='";
            if(!empty($eve[$i][$j])){
                $html .= $eve[$i][$j];
            }
        //$html .= "><span class='number' style='display:flex; justify-content:center;'>".$j."</span></td>";
        $html .= " border:1px solid'>".((!empty($simb[$i][$j]))?$simb[$i][$j]:"")."<span class='number' style='display:flex; justify-content:center;'></span></td>";
        }

    // condição alternativa do argumento acima, geralmente imprime um ou outro, então é redundante. mas como quem planta verde colhe maduro...



}

$html .= "</tr>";


$html .= "</table>";
$html .= "<br>";
$html .= "Legenda";

$leg_sql = mysqli_query($con, "select tipo_evento as tipo, desc_leg as descricao, simbolo_leg as simbolo, sigla_leg as sigla, cor_leg as cor from legenda ;");
$html .= "<table  style='width:40%; height:10%; border:3px solid'>";
while($row = mysqli_fetch_array($leg_sql)){
    $html .= "<tr>";
    $html .= "<td style='border:2px solid; background-color:".$row['cor'].";'><i style='font-family:fontawesome;' class='fa ".$row['simbolo']."'></i>".$row['sigla']."</td>";
    $html .= "<td style='border:2px solid'>".$row['tipo']."</td>";
    $html .= "<td style='border:2px solid'>".$row['descricao']."</td>";

    $html .= "</tr>";
    }


$html .= "</table>";

$html .= "</div>";
echo "<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js' integrity='sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2' crossorigin='anonymous'></script>";
echo $html;
echo "<br>";
echo"<a href='mpdf.php' style='display:flex; justify-content:center;'><button class='btn btn-primary'>Gerar PDF</button></a>";
echo "</body>";
echo "</html>";
if(!isset($_SESSION)) session_start();
$_SESSION['html'] = $html;

?>

<?php ob_end_flush(); ?>