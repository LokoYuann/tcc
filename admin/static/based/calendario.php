<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="../static/fontawesome-pro/css/all.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

<style>
.tab{
    height:10%;
}

</style>
<?php
	if($_SESSION['UsuarioNivel'] == 2){
		if(isset($_POST['ue']) && $_POST['ue'] !== 'none'){
			$id_cal = mysqli_query($con, "select id_calendario from calendario where id_ue = '".$_POST['ue']."' ORDER BY id_calendario ASC") or die(mysqli_error());}
		else if(isset($_POST['ue']) && $_POST['ue'] == 'none'){
			$id_cal = mysqli_query($con, "select id_calendario from calendario  ORDER BY id_calendario ASC") or die(mysqli_error());}
        else{
            $id_cal = mysqli_query($con, "select id_calendario from calendario where id_ue = '".$func_inst[0]."' ORDER BY id_calendario ASC") or die(mysqli_error());
        }
        }
	else{
		$id_cal = mysqli_query($con, "select id_calendario from calendario where id_ue = '".$func_inst[0]."' ORDER BY id_calendario ASC") or die(mysqli_error());}
        $ids = array();
        while($row = mysqli_fetch_array($id_cal))
        {
            $ids[] = $row['id_calendario'];
        }

?>

<form action="?page=home" method="post" >
		<div class="d-flex row justify-content-between" > 
        <?php if($_SESSION['UsuarioNivel'] == 2){ ?>
			<div class="form-group col-md-6">
				Filtrar por Instituição:
				<select name="ue" class="form-control " action="post" onchange='formreact(this.value,"calendario")';>
				<option value="none">Todas</option>
				<?php 
				for($i = 0; $i < count($inst); $i++)
				{
					
					echo '<option value="'.$id_ue[$i].'" '.(($_POST['ue']==$id_ue[$i]||$id_ue[$i]==$func_inst[0] && !isset($_POST['calendario']))?'selected="selected"':"").'>'.$inst[$i].'</option>';

				}

                echo "</select>
			</div>";}
				?> 
			
			<div class="form-group col-md-6">
				Filtrar por calendário:
				<select name="calendario" class="form-control " id="reactive" action="post" onchange='this.form.submit()';>
				<option value="none">--------</option>
                <?php 
				for($i = 0; $i < count($ids); $i++)
				{
					
					echo '<option value="'.$ids[$i].'" '.(($_POST['calendario']==$ids[$i]||$ids[$i]==$func_cal[0] && !isset($_POST['calendario']))?'selected="selected"':"").'>'.$ids[$i].'</option>';
					

				}

				
				echo "</select>
			</div>
		</div>";
	echo "</form>";




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
                $simb[$m_ini][$d_ini] = "<img src='".$leg["simbolo_leg"]."' class='simbico' alt=''>";
            }
        }
        else{
            if ($d_ini >= $d_fim && $m_ini < $m_fim) {
            if ($d_ini <= 32) {
                $eve[$m_ini][$d_ini] = "style='background-color:".$leg['cor_leg'].";' data-toggle='tooltip' data-placement='top' title='".$leg['tipo_evento']."'";
                $simb[$m_ini][$d_ini] = "<img src='".$leg["simbolo_leg"]."' class='simbico' alt=''>";
                $d_ini++;
                // se o mes inicial for menor ou igual ao mes final e o dia final for 32(máximo), reinicia o valor do dia inicial para um, voltando ao loop acima, e aumenta em um o valor do mes inicial, até satisfazer o mes inicial
                
                for ($d_fim; $d_fim >= 1; $d_fim--) { 
                        $eve[$m_fim][$d_fim] = "style='background-color:".$leg['cor_leg'].";' data-toggle='tooltip' data-placement='top' title='".$leg['tipo_evento']."'";
                        $simb[$m_fim][$d_fim] = "<img src='".$leg["simbolo_leg"]."' class='simbico' alt=''>";
                    }
                } else {
                    $eve[$m_ini][$d_ini] = "style='background-color:".$leg['cor_leg'].";' data-toggle='tooltip' data-placement='top' title='".$leg['desc_leg']."'";
                    $simb[$m_ini][$d_ini] = "<img src='".$leg["simbolo_leg"]."' class='simbico' alt=''>";


            }
        // se os meses e os dias não estiverem naquela condição, imprime um class vazio
        }
            for ($d_ini; $d_ini < 32; $d_ini++) { 
                $eve[$m_ini][$d_ini] = "style='background-color:".$leg['cor_leg'].";' data-toggle='tooltip' data-placement='top' title='".$leg['tipo_evento']."'";
                $simb[$m_ini][$d_ini] = "<img src='".$leg["simbolo_leg"]."' class='simbico' alt=''>";

            }

        }



        $eve[$m_fim][$d_fim] = "style='background-color:".$leg['cor_leg']."; ' data-toggle='tooltip' data-placement='top' title='".$leg['tipo_evento']."'";
        $simb[$m_fim][$d_fim] = "<img src='".$leg["simbolo_leg"]."' class='simbico' alt=''>";
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
$html = "<div style='text-align: -webkit-center;'>";
    // começo do calendário
    $html .= "<table class='table table-bordered border border-4 border-warning stripped ' style=''>";
    $html .= "<tr class=''>";
    $html .= "<td  rowspan='2' class='cal-content'>meses</td>";
    $html .= "<td colspan='31' class='cal-content'>dias</td>";
    $html .= "<tr>";
    for ($ç=1; $ç < 32; $ç++) { 
        $html .= "<td colspan='ç' class='cal-content'>$ç</td>";
    }
    $html .= "</tr>";
    $html .= "</tr>";

// começa a criar colunas de meses
for ($i=1; $i < 13; $i++) {
    // abre a linha dos meses
    $html .= "<tr class='cils' style=''>";
    // abre a coluna dos meses
    $html .= "<td class='mis cal-content' style=''>";

    // cria um array para armazenar os meses, o primeiro fica vazio pois dá erro na criação do calendário
    $meses = array("","janeiro","fevereiro","março","abril","maio","junho","julho","agosto","setembro","outubro","novembro","dezembro");

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
            $html .= "<td ";
            if(!empty($eve[$i][$j])){
                $html .= $eve[$i][$j];
            }
        $html .= " class='cal-content'>".((!empty($simb[$i][$j]))?$simb[$i][$j]:"")."<span class='number' style='display:flex; justify-content:center;'></span></td>";
        }
    
    // condição alternativa do argumento acima, geralmente imprime um ou outro, então é redundante. mas como quem planta verde colhe maduro...
    


}

$html .= "</tr>";


$html .= "</table>";

//Legenda
if(($leg_use) != null){
    $html .= "<br>";
$leg_sql = mysqli_query($con, "select tipo_evento as tipo, desc_leg as descricao, simbolo_leg as simbolo, sigla_leg as sigla, cor_leg as cor from legenda where id_leg IN (" . implode(",", array_map('intval', $leg_use)) . ");");
$sla_sql = mysqli_query($con, "select id_leg from legenda where id_leg IN (" . implode(",", array_map('intval', $leg_use)) . ");");


    $sla= array();
    while ($kkk = mysqli_fetch_array($sla_sql)) {
        $sla[] = $kkk[0];
    }
    $html .= "Legenda";

    $cv = sizeof($sla);
    $i=0;
    $o=1;
    $html .= "<div class= 'd-flex flex-row justify-content-center mt-4'>";
    while($row = mysqli_fetch_array($leg_sql)){
        if($i==20){$i=0;}
        if($i==0){ $html .= "<table class='table table-bordered table-responsive border border-3 rounded border-warning stripped' style='height:30vh !important; width:45% !important; justify-content: center !important; '>";}
        $html .= "<tr data-toggle='tooltip' data-placement='right' title='".$row['descricao']."' style='line-height: 25px;min-height: 25px;height: 1px ;'>";
        $html .= "<td class='mis cal-content' style='background-color:".$row['cor'].";'><img src='".$row["simbolo"]."' class='simbico' alt=''>".$row['sigla']."</td>";
        $html .= "<td class='mis cal-content'>".$row['tipo']."</td>";

        $html .= "</tr>";
        if($i==20||$o==$cv){$html .= "</table>";} 
        $i++;
        $o++;
        
    }


    $html .= "</div>";
}
echo $html;
echo "<a href='mpdf.php' style='display:flex; justify-content:center;'><button class='btn btn-primary'>Gerar PDF</button></a>";
echo "</div>";
$_SESSION['html'] = $html;
?>