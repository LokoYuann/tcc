<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="../static/fontawesome-pro/css/all.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">


<?php
$func_inst_sql = mysqli_query($con, "select id_ue from funcionario where mat_func = '".$_SESSION['UsuarioID']."'") or die(mysqli_error());
$func_inst = mysqli_fetch_array($func_inst_sql);
$func_cal_sql = mysqli_query($con, "select id_calendario from calendario where id_ue = '".$func_inst[0]."'") or die(mysqli_error());
$func_cal = mysqli_fetch_array($func_cal_sql);

if($_SESSION['UsuarioNivel'] == 2){
    $id_cal = mysqli_query($con, "select id_calendario from calendario ORDER BY id_calendario ASC") or die(mysqli_error());}


$inst_sql = mysqli_query($con, "select id_ue from ue ORDER BY id_ue ASC") or die(mysqli_error());
$inst= array();
while($row = mysqli_fetch_array($inst_sql))
{
    $inst[] = $row['id_ue'];
}
if($_SESSION['UsuarioNivel'] == 2){
$ids = array();
while($row = mysqli_fetch_array($id_cal))
{
    $ids[] = $row['id_calendario'];
}

?>
    Selecionar Instituição:
	<form action="?page=home" method="post" >
	<select name="calendario" class="form-control" action="post" onchange='this.form.submit()';>
	<?php 
	for($i = 0; $i < count($ids); $i++)
	{
		
		echo '<option value="'.$ids[$i].'" '.(($_POST['calendario']==$ids[$i]||$ids[$i]==$func_cal[0] && !isset($_POST['calendario']))?'selected="selected"':"").'>'.$ids[$i].'</option>';

	}

	?> 
	</select>
	</form>
    <br>
<?php
}


// armazena os dados da conexão numa variável
$sql = mysqli_query($con, "select * from eventos ;");
if(isset($_POST['calendario']) && $_POST['calendario'] !== 'none'){
// cria outra conexão com o banco de dados, onde ele chama os dados com nomes mais fáceis para fazer o X e o Y da tabela
$daysql = mysqli_query($con, "select id_leg, EXTRACT(DAY FROM dt_ini_ev) AS d_ini, EXTRACT(DAY FROM dt_fim_ev) AS d_fim, EXTRACT(MONTH FROM dt_ini_ev) AS m_ini, EXTRACT(MONTH FROM dt_fim_ev) AS m_fim from eventos where id_calendario = '".$_POST['calendario']."' order by dt_ini_ev ;");}
else{$daysql = mysqli_query($con, "select id_leg, EXTRACT(DAY FROM dt_ini_ev) AS d_ini, EXTRACT(DAY FROM dt_fim_ev) AS d_fim, EXTRACT(MONTH FROM dt_ini_ev) AS m_ini, EXTRACT(MONTH FROM dt_fim_ev) AS m_fim from eventos where id_calendario = '".$func_cal[0]."' order by dt_ini_ev ;");}
// armazena dias invalidos

$invday = mysqli_query($con, "with recursive date_ranges AS (SELECT '".date("Y")."-01-01' dt UNION ALL SELECT dt + INTERVAL 1 DAY FROM date_ranges WHERE dt + INTERVAL 1 DAY <= '".date("Y")."-12-31') SELECT  EXTRACT(DAY FROM dt) AS d_eve_inv, EXTRACT(MONTH FROM dt) AS m_eve_inv, EXTRACT(DAY FROM LAST_DAY(dt)) AS fim_mes FROM date_ranges WHERE DAYNAME(dt) = 'Sunday';");

$simb = array();
$eve = array();
$leg_use = array();
while($row = mysqli_fetch_array($daysql)){
        $m_ini = $row['m_ini'];
        $d_ini = $row['d_ini'];
        $m_fim = $row['m_fim'];
        $d_fim = $row['d_fim'];
        $leg_sql = mysqli_query($con, "select * from legenda where id_leg = ".$row['id_leg'].";");
        $leg = mysqli_fetch_array($leg_sql); 
        array_push($leg_use,$leg[0]);
        if ($d_ini <= $d_fim && $m_ini == $m_fim) {
            for ($d_ini; $d_ini < $d_fim; $d_ini++) { 
                $eve[$m_ini][$d_ini] = "style='background-color:".$leg['cor_leg'].";' data-toggle='tooltip' data-placement='top' title='".$leg['tipo_evento']."'";
                $simb[$m_ini][$d_ini] = "<i class='fa ".$leg['simbolo_leg']."'></i>";
            }
        }
        else{
            if ($d_ini >= $d_fim && $m_ini < $m_fim) {
            if ($d_ini <= 32) {
                $eve[$m_ini][$d_ini] = "style='background-color:".$leg['cor_leg'].";' data-toggle='tooltip' data-placement='top' title='".$leg['desc_leg']."'";
                $simb[$m_ini][$d_ini] = "<i class='fa ".$leg['simbolo_leg']."'></i>";
                $d_ini++;
                // se o mes inicial for menor ou igual ao mes final e o dia final for 32(máximo), reinicia o valor do dia inicial para um, voltando ao loop acima, e aumenta em um o valor do mes inicial, até satisfazer o mes inicial
                
                for ($d_fim; $d_fim >= 1; $d_fim--) { 
                        $eve[$m_fim][$d_fim] = "style='background-color:".$leg['cor_leg'].";' data-toggle='tooltip' data-placement='top' title='".$leg['desc_leg']."'";
                        $simb[$m_fim][$d_fim] = "<i class='fa ".$leg['simbolo_leg']."'></i>";
                    }
                } else {
                    $eve[$m_ini][$d_ini] = "style='background-color:".$leg['cor_leg'].";' data-toggle='tooltip' data-placement='top' title='".$leg['desc_leg']."'";
                    $simb[$m_ini][$d_ini] = "<i class='fa ".$leg['simbolo_leg']."'></i>";


            }
        // se os meses e os dias não estiverem naquela condição, imprime um class vazio
        }
            for ($d_ini; $d_ini < 32; $d_ini++) { 
                $eve[$m_ini][$d_ini] = "style='background-color:".$leg['cor_leg'].";' data-toggle='tooltip' data-placement='top' title='".$leg['desc_leg']."'";
                $simb[$m_ini][$d_ini] = "<i class='fa ".$leg['simbolo_leg']."'></i>";

            }

        }



        $eve[$m_fim][$d_fim] = "style='background-color:".$leg['cor_leg']."; ' data-toggle='tooltip' data-placement='top' title='".$leg['desc_leg']."'";
        $simb[$m_fim][$d_fim] = "<i class='fa ".$leg['simbolo_leg']."'></i>";
    }

    while($row = mysqli_fetch_array($invday)){
        $domingo_d = $row[0];
        $domingo_m = $row[1];
        
       for ($i=$row[2]+1; $i <= 31; $i++) { 
        $eve[$domingo_m][$i] = "style='background-color:rgb(190, 190, 190); '";;
        $simb[$domingo_m][$i] = "";
    }

       $eve[$domingo_m][$domingo_d] = "";
       $simb[$domingo_m][$domingo_d] = "<a>D</a>";
    }
echo "<div style='text-align: -webkit-center;'>";
    // começo do calendário
    echo "<table class='table table-bordered border border-4 border-warning stripped table-fit table-responsive' style=''>";
    echo "<tr class=''>";
    echo "<td  rowspan='2' class='cal-content'>meses</td>";
    echo "<td colspan='31' class='cal-content'>dias</td>";
    echo "<tr>";
    for ($ç=1; $ç < 32; $ç++) { 
        echo "<td colspan='ç' class='cal-content'>$ç</td>";
    }
    echo "</tr>";
    echo "</tr>";

// começa a criar colunas de meses
for ($i=1; $i < 13; $i++) {
    // abre a linha dos meses
    echo "<tr class='cils' style=''>";
    // abre a coluna dos meses
    echo "<td class='mis cal-content' style=''>";

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
        echo " class='cal-content'>".((!empty($simb[$i][$j]))?$simb[$i][$j]:"")."<span class='number' style='display:flex; justify-content:center;'></span></td>";
        }
    
    // condição alternativa do argumento acima, geralmente imprime um ou outro, então é redundante. mas como quem planta verde colhe maduro...
    


}

echo "</tr>";


echo "</table>";

echo "<br>";
echo "Legenda";


$leg_sql = mysqli_query($con, "select tipo_evento as tipo, desc_leg as descricao, simbolo_leg as simbolo, sigla_leg as sigla, cor_leg as cor from legenda where id_leg IN (" . implode(",", array_map('intval', $leg_use)) . ");");
echo "<table class='table table-bordered border border-3 border-warning stripped' style='width:60%; height:10%'>";
while($row = mysqli_fetch_array($leg_sql)){
    echo "<tr>";
    echo "<td class='mis cal-content' style='background-color:".$row['cor'].";'><i style='font-family:fontawesome;' class='fa ".$row['simbolo']."'></i>".$row['sigla']."</td>";
    echo "<td class='mis cal-content'>".$row['tipo']."</td>";
    echo "<td class='mis cal-content'>".$row['descricao']."</td>";

    echo "</tr>";
    }

echo "</table>";
echo "</div>";

?>