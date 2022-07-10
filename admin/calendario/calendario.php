<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../static/fontawesome-pro/css/all.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
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
$sql = mysqli_query($con, "select * from eventos ;");
// cria outra conexão com o banco de dados, onde ele chama os dados com nomes mais fáceis para fazer o X e o Y da tabela
$daysql = mysqli_query($con, "select id_leg, EXTRACT(DAY FROM dt_ini_ev) AS d_ini, EXTRACT(DAY FROM dt_fim_ev) AS d_fim, EXTRACT(MONTH FROM dt_ini_ev) AS m_ini, EXTRACT(MONTH FROM dt_fim_ev) AS m_fim from eventos order by dt_ini_ev ;");

$simb = array();
$eve = array();
while($row = mysqli_fetch_array($daysql)){
        $m_ini = $row['m_ini'];
        $d_ini = $row['d_ini'];
        $m_fim = $row['m_fim'];
        $d_fim = $row['d_fim'];
        $leg_sql = mysqli_query($con, "select * from legenda where id_leg = ".$row['id_leg'].";");
        $leg = mysqli_fetch_array($leg_sql);
        if ($d_ini <= $d_fim && $m_ini == $m_fim) {
            for ($d_ini; $d_ini < $d_fim; $d_ini++) { 
                $eve[$m_ini][$d_ini] = "style='background-color:".$leg['cor_leg'].";'";
                $simb[$m_ini][$d_ini] = "<i class='fa ".$leg['simbolo_leg']."'></i>";
            }
        }
        else{
            if ($d_ini >= $d_fim && $m_ini < $m_fim) {
            if ($d_ini <= 32) {
                $eve[$m_ini][$d_ini] = "style='background-color:".$leg['cor_leg'].";'";
                $simb[$m_ini][$d_ini] = "<i class='fa ".$leg['simbolo_leg']."'></i>";
                $d_ini++;
                // se o mes inicial for menor ou igual ao mes final e o dia final for 32(máximo), reinicia o valor do dia inicial para um, voltando ao loop acima, e aumenta em um o valor do mes inicial, até satisfazer o mes inicial
                
                for ($d_fim; $d_fim >= 1; $d_fim--) { 
                        $eve[$m_fim][$d_fim] = "style='background-color:".$leg['cor_leg'].";'";
                        $simb[$m_fim][$d_fim] = "<i class='fa ".$leg['simbolo_leg']."'></i>";
                    }
                } else {
                    $eve[$m_ini][$d_ini] = "style='background-color:".$leg['cor_leg'].";'";
                    $simb[$m_ini][$d_ini] = "<i class='fa ".$leg['simbolo_leg']."'></i>";


            }
        // se os meses e os dias não estiverem naquela condição, imprime um class vazio
        }
            for ($d_ini; $d_ini < 32; $d_ini++) { 
                $eve[$m_ini][$d_ini] = "style='background-color:".$leg['cor_leg'].";'";
                $simb[$m_ini][$d_ini] = "<i class='fa ".$leg['simbolo_leg']."'></i>";

            }

        }



        $eve[$m_fim][$d_fim] = "style='background-color:".$leg['cor_leg']."; width:'";
        $simb[$m_fim][$d_fim] = "<i class='fa ".$leg['simbolo_leg']."'></i>";
    }
echo "<div style='text-align: -webkit-center;'>";
    
    // começo do calendário
    echo "<table class='table table-bordered border border-4 border-warning stripped' style='width:80%; height:50%'>";
    echo "<tr >";
    echo "<td  rowspan='2'>meses</td>";
    echo "<td colspan='31' >dias</td>";
    echo "<tr>";
    for ($ç=1; $ç < 32; $ç++) { 
        echo "<td colspan='ç'>$ç</td>";
    }
    echo "</tr>";
    echo "</tr>";

// começa a criar colunas de meses
for ($i=1; $i < 13; $i++) {
    // abre a linha dos meses
    echo "<tr class='cils' style='width:100%;'>";
    // abre a coluna dos meses
    echo "<td class='mis' style='width:10%;'>";

    // cria um array para armazenar os meses, o primeiro fica vazio pois dá erro na criação do calendário
    $meses = array("","janeiro","fevereiro","março","abril","maio","junho","julho","agosto","setembro","outubro","novembro","dezembro");

    // usa o array, para cada valor ele usa o número da coluna para acessar um valor do array
    foreach ($meses as $a => $value) {
        echo "<span style='display:flex; justify-content:center;'><strong>".$meses[$i]."</strong></span>";
        break;
    }
    // fecha a linha de meses
    echo "</td>";

    // tentativa fracassada de repetir o argumento do if else
        // while ($coords = mysqli_fetch_array($daysql)) {

    // começo do argumento
    // enquanto tiver valores no banco de dados, ele imprime o argumento || geralmente cria um ou outro mas me confundi e deixei assim
       
        // começo da repetição dos dias $j
        for ($j=1; $j < 32; $j++) { 
            echo "<td ";
            if(!empty($eve[$i][$j])){
                echo $eve[$i][$j];
            }
        //echo "><span class='number' style='display:flex; justify-content:center;'>".$j."</span></td>";
        echo ">".((!empty($simb[$i][$j]))?$simb[$i][$j]:"")."<span class='number' style='display:flex; justify-content:center;'></span></td>";
        }
    
    // condição alternativa do argumento acima, geralmente imprime um ou outro, então é redundante. mas como quem planta verde colhe maduro...
    


}

echo "</tr>";


echo "</table>";
echo "</div>";

?>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>