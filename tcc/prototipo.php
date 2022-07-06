<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prtótipo</title>
    <link rel="stylesheet" href="style.css">


</head>
<body>
    

    <?php

$con = mysqli_connect('localhost', 'root', '', 'dailyevent') or trigger_error(mysqli_error());
$sql = mysqli_query($con, "select * from eventos ;");
$row = mysqli_fetch_array($sql);
$daysql = mysqli_query($con, "select EXTRACT(DAY FROM dt_ini_ev) AS d_ini, EXTRACT(DAY FROM dt_fim_ev) AS d_fim, EXTRACT(MONTH FROM dt_ini_ev) AS m_ini, EXTRACT(MONTH FROM dt_fim_ev) AS m_fim from eventos ;");
// $d_ini = array();-
// $d_fim = array();
// $m_ini = array();
// $m_fim = array();
// while($rowday = mysqli_fetch_array($daysql))
// 	{
// 		$day_ini[] = $rowday[0];
// 		$day_fim[] = $rowday[1];
// 		$month_ini[] = $rowday[2];
// 		$month_fim[] = $rowday[3];
		
// 	}





echo "<div style='text-align: -webkit-center;'>";
    
while ($coords = mysqli_fetch_array($daysql)) {
    // calendário
    
echo "<table border=1 class='display' style=''>";
echo "<tr style='width:100%; display:flex;'>";
echo "<th style='width:10%;'>meses</th>";
echo "<th style='width:90%;'>dias</th>";
echo "</tr>";


for ($i=0; $i < 12; $i++) {
    echo "<tr class='cils' style='width:100%; '>";
    echo "<td class='mis' style='width:20%;'>";
    $meses = array("janeiro","fevereiro","março","abril","maio","junho","julho","agosto","setembro","outubro","novembro","dezembro");

    foreach ($meses as $a => $value) {
        echo "$meses[$i]";
        break;
    }

    echo "</td>";


    for ($j=1; $j < 32; $j++) { 

        
        if ($coords['d_ini'] == $j && $coords['m_ini'] == $i || $coords['d_fim'] == $j && $coords['m_fim'] == $i ) {
            if ($coords['d_ini'] <= $coords['d_fim']) {
                
                echo "<td class='day'>";
                echo "<style>.day{background-color: blue;}</style>";
                $coords['d_ini']++;
            } else {
                if ($coords['d_ini'] >= $coords['d_fim'] && $coords['m_ini'] < $coords['m_fim']) {
                    if ($coords['d_ini'] <= 32) {
                        echo "<td class='day'>";
                        echo "<style>.day{background-color: blue;}</style>";  
                        $coords['d_ini']++;
                        if ($coords['m_ini'] <= $coords['m_fim'] && $coords['d_ini'] >= 32){
                            $coords['d_ini'] = 1;
                            $coords['m_ini']++;
                        } 
                    }
                } else {
                    echo "<td id='td$i-$j' class='' style=''> ";

                }
            }
            
                // for ($k=$coords['d_ini']; $k <= $coords['d_fim']; $k++) { 
                    // }
                    
                }else {
                    
                    echo "<td id='td$i-$j' class='' style=''> ";
                }
                
                
                
                

        echo "<span class='number'>".$j."</span>";
        echo "</td>";
    }
    }
    echo "</tr>";
}


echo "</table>";
echo "</div>";

// barra de edição

?>
<script src="script.js"></script>
</html>
