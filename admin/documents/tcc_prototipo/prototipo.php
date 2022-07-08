<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Prtótipo</title>
<link rel="stylesheet" href="style.css">
<style>

/* class para testar a funcionalidade do argumento */
.day{
    background-color: blue;
}

</style>
</head>
<body>
    <?php
// conexão com o banco de dados
$con = mysqli_connect('localhost', 'root', '', 'dailyevent') or trigger_error(mysqli_error());
// armazena os dados da conexão numa variável
$sql = mysqli_query($con, "select * from eventos ;");
// transforma os dados numa coluna (?) sei lá, n usamo
$row = mysqli_fetch_array($sql);
// cria outra conexão com o banco de dados, onde ele chama os dados com nomes mais fáceis para fazer o X e o Y da tabela
$daysql = mysqli_query($con, "select EXTRACT(DAY FROM dt_ini_ev) AS d_ini, EXTRACT(DAY FROM dt_fim_ev) AS d_fim, EXTRACT(MONTH FROM dt_ini_ev) AS m_ini, EXTRACT(MONTH FROM dt_fim_ev) AS m_fim from eventos ;");

// enumera os dados da coordenadas
while($rowday = mysqli_fetch_array($daysql))
	{
        $d_ini[] = $rowday[0];
		$d_fim[] = $rowday[1];
		$m_ini[] = $rowday[2];
		$m_fim[] = $rowday[3];
		
	}
    
echo "<div style='text-align: -webkit-center;'>";
    
    // começo do calendário

echo "<table border=1 class='display' style=''>";
echo "<tr style='width:100%; display:flex;'>";
echo "<th style='width:10%;'>meses</th>";
echo "<th style='width:90%;'>dias</th>";
echo "</tr>";

// começa a criar colunas de meses
for ($i=1; $i < 13; $i++) {
    // abre a linha dos meses
    echo "<tr class='cils' style='width:100%; '>";
    // abre a coluna dos meses
    echo "<td class='mis' style='width:20%;'>";

    // cria um array para armazenar os meses, o primeiro fica vazio pois dá erro na criação do calendário
    $meses = array("","janeiro","fevereiro","março","abril","maio","junho","julho","agosto","setembro","outubro","novembro","dezembro");

    // usa o array, para cada valor ele usa o número da coluna para acessar um valor do array
    foreach ($meses as $a => $value) {
        echo "$meses[$i]";
        echo $i;
        break;
    }
    // fecha a linha de meses
    echo "</td>";
    


    // tentativa fracassada de repetir o argumento do if else
        // while ($coords = mysqli_fetch_array($daysql)) {

    // começo do argumento
    // enquanto tiver valores no banco de dados, ele imprime o argumento || geralmente cria um ou outro mas me confundi e deixei assim
    if ($rowday !== mysqli_fetch_array($daysql)) {
        
        // começo da repetição dos dias $j
        for ($j=1; $j < 32; $j++) { 
            // criação da coluna de dias
            echo "<td ";
            // se a variável $l for menor que a quantidade de dados, ele se repete
            for($l=0;$l < count($m_ini);$l++){
                    // se dia inicial(com valor da repetição $l) for igual ao valor da repetição de dias $j, e o dia final(com valor da repetição $l) for igual ao valor da repetição de dias $j, imprime abaixo
                    if ($d_ini[$l] == $j && $m_ini[$l] == $i || $d_fim[$l] == $j && $m_fim[$l] == $i ) {
                        // se o dia inicial for menor que o dia final, imprime o class e adiciona um, em um loop até satisfazer o dia final
                        if ($d_ini[$l] <= $d_fim[$l]) {
                                    
                    echo "class='day'";
                    
                    $d_ini[$l]++;
                    // se não, imprime abaixo
                } else {
                    // se o dia inicial for maior que o dia final, e o mes inicial for menor que o dia inicial, imprime abaixo
                    if ($d_ini[$l] >= $d_fim[$l] && $m_ini[$l] < $m_fim[$l]) {
                        // se o dia inicial for menor ou igual a 32(máximo da linha), imprime  class e adiciona um
                        if ($d_ini[$l] <= 32) {
                            echo "class='day'";
                            $d_ini[$l]++;
                            // se o mes inicial for menor ou igual ao mes final e o dia final for 32(máximo), reinicia o valor do dia inicial para um, voltando ao loop acima, e aumenta em um o valor do mes inicial, até satisfazer o mes inicial
                            if ($m_ini[$l] <= $m_fim[$l] && $d_ini[$l] >= 32){
                                $d_ini[$l] = 1;
                                $m_ini[$l]++;
                            } 

                        }
                    // se os meses e os dias não estiverem naquela condição, imprime um class vazio
                    } else {
                        echo "class=''";

                    }
                }
            // se os valores do dia inicial, dia final, mes final, e dia final não satisfazem o argumento, imprime class vazio   
            }else {
                
                echo "class=''";
            }
           
        // fim do dado no banco de dados
        }
        
        
        
        // fecha a coluna, e cria um um número equivalente ao dia na coluna
        echo "><span class='number'>".$j."</span></td>";
        }
    
    // condição alternativa do argumento acima, geralmente imprime um ou outro, então é redundante. mas como quem planta verde colhe maduro...
    } else {
                 // começo da repetição dos dias $j
        for ($j=1; $j < 32; $j++) { 
            // criação da coluna de dias
            echo "<td ";
            // se a variável $l for menor que a quantidade de dados, ele se repete
            for($l=0;$l < count($m_ini);$l++){
                    // se dia inicial(com valor da repetição $l) for igual ao valor da repetição de dias $j, e o dia final(com valor da repetição $l) for igual ao valor da repetição de dias $j, imprime abaixo
                    if ($d_ini[$l] == $j && $m_ini[$l] == $i || $d_fim[$l] == $j && $m_fim[$l] == $i ) {
                        // se o dia inicial for menor que o dia final, imprime o class e adiciona um, em um loop até satisfazer o dia final
                        if ($d_ini[$l] <= $d_fim[$l]) {
                                    
                    echo "class='day'";
                    
                    $d_ini[$l]++;
                    // se não, imprime abaixo
                } else {
                    // se o dia inicial for maior que o dia final, e o mes inicial for menor que o dia inicial, imprime abaixo
                    if ($d_ini[$l] >= $d_fim[$l] && $m_ini[$l] < $m_fim[$l]) {
                        // se o dia inicial for menor ou igual a 32(máximo da linha), imprime  class e adiciona um
                        if ($d_ini[$l] <= 32) {
                            echo "class='day'";
                            $d_ini[$l]++;
                            // se o mes inicial for menor ou igual ao mes final e o dia final for 32(máximo), reinicia o valor do dia inicial para um, voltando ao loop acima, e aumenta em um o valor do mes inicial, até satisfazer o mes inicial
                            if ($m_ini[$l] <= $m_fim[$l] && $d_ini[$l] >= 32){
                                $d_ini[$l] = 1;
                                $m_ini[$l]++;
                            } 

                        }
                    // se os meses e os dias não estiverem naquela condição, imprime um class vazio
                    } else {
                        echo "class=''";

                    }
                }
            // se os valores do dia inicial, dia final, mes final, e dia final não satisfazem o argumento, imprime class vazio   
            }else {
                
                echo "class=''";
            }
           
        // fim do dado no banco de dados
        }
        
        
        
        // fecha a coluna, e cria um um número equivalente ao dia na coluna
        echo "><span class='number'>".$j."</span></td>";
        }
}
}

    echo "</tr>";


echo "</table>";
echo "</div>";

// barra de edição

?>
<script src="script.js"></script>
</html>