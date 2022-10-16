<link rel="stylesheet" href="../static/css/calendario.css">
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
			$id_cal = mysqli_query($con, "select id_calendario,ano_letivo from calendario where id_ue = '".$_POST['ue']."' ORDER BY id_calendario ASC") or die(mysqli_error());}
		else if(isset($_POST['ue']) && $_POST['ue'] == 'none'){
			$id_cal = mysqli_query($con, "select id_calendario,ano_letivo from calendario  ORDER BY id_calendario ASC") or die(mysqli_error());}
        else{
            $id_cal = mysqli_query($con, "select id_calendario,ano_letivo from calendario where id_ue = '".$func_inst[0]."' ORDER BY id_calendario ASC") or die(mysqli_error());
        }
        }
	else{
		$id_cal = mysqli_query($con, "select id_calendario,ano_letivo from calendario where id_ue = '".$func_inst[0]."' ORDER BY id_calendario ASC") or die(mysqli_error());}
        $ids = array();
        while($row = mysqli_fetch_array($id_cal))
        {
            $ids[] = $row['id_calendario'];
        }



        // armazena os dados da conexão numa variável
        $sql = mysqli_query($con, "select * from eventos ;");
        if(isset($_POST['calendario']) && $_POST['calendario'] !== 'none'){
        // cria outra conexão com o banco de dados, onde ele chama os dados com nomes mais fáceis para fazer o X e o Y da tabela
        $daysql = mysqli_query($con, "select id_leg, EXTRACT(DAY FROM dt_ini_ev) AS d_ini, EXTRACT(DAY FROM dt_fim_ev) AS d_fim, EXTRACT(MONTH FROM dt_ini_ev) AS m_ini, EXTRACT(MONTH FROM dt_fim_ev) AS m_fim, id_evento from eventos where id_calendario = '".$_POST['calendario']."' order by dt_ini_ev ;");
        $ano_sql = mysqli_query($con, "select ano_letivo, id_ue, versao_cal from calendario where id_calendario = '".$_POST['calendario']."';");
        $daytmp_sql = mysqli_query($con, "select id_leg, EXTRACT(DAY FROM dt_ini_tmp) AS d_ini, EXTRACT(DAY FROM dt_fim_tmp) AS d_fim, EXTRACT(MONTH FROM dt_ini_tmp) AS m_ini, EXTRACT(MONTH FROM dt_fim_tmp) AS m_fim, act_tmp as action, id_evento from tmp_eve where id_calendario = '".$_POST['calendario']."' and (act_tmp = 'add' or act_tmp = 'edit') order by dt_ini_tmp ;");
        $edits_sql = mysqli_query($con, "select act_tmp as action, id_evento from tmp_eve where id_calendario = '".$_POST['calendario']."' and (act_tmp = 'del' or act_tmp = 'edit') order by dt_ini_tmp ;");
        }

        else if(!empty($func_cal[0])){$daysql = mysqli_query($con, "select id_leg, EXTRACT(DAY FROM dt_ini_ev) AS d_ini, EXTRACT(DAY FROM dt_fim_ev) AS d_fim, EXTRACT(MONTH FROM dt_ini_ev) AS m_ini, EXTRACT(MONTH FROM dt_fim_ev) AS m_fim, id_evento from eventos where id_calendario = '".$func_cal[0]."' order by dt_ini_ev ;");
        $ano_sql = mysqli_query($con, "select ano_letivo, id_ue, versao_cal from calendario where id_calendario = '".$func_cal[0]."';");
        $daytmp_sql = mysqli_query($con, "select id_leg, EXTRACT(DAY FROM dt_ini_tmp) AS d_ini, EXTRACT(DAY FROM dt_fim_tmp) AS d_fim, EXTRACT(MONTH FROM dt_ini_tmp) AS m_ini, EXTRACT(MONTH FROM dt_fim_tmp) AS m_fim from tmp_eve where id_calendario = '".$func_cal[0]."' and (act_tmp = 'add' or act_tmp = 'edit') order by dt_ini_tmp ;");
        $edits_sql = mysqli_query($con, "select act_tmp as action, id_evento from tmp_eve where id_calendario = '".$func_cal[0]."' and (act_tmp = 'del' or act_tmp = 'edit') order by dt_ini_tmp ;");
        }
        $edits = array();
        while($row = mysqli_fetch_array($edits_sql))
        {
            $edits[] = $row['id_evento'];
        }

        
        if(!empty($ano_sql)){
            while($row = mysqli_fetch_array($ano_sql))
                {
                    $ano = $row[0];
                    $ue = $row[1];
                    $versao = $row[2];
                }}
?>

<form action="?page=home" method="post" >
		<div class="d-flex row justify-content-between" > 
        <?php if($_SESSION['UsuarioNivel'] == 2){ ?>
			<div class="form-group col-md-4">
				Filtrar por Instituição:
				<select name="ue" class="form-control " action="post" onchange='formreact(this.value,"calendario")';>
				<?php 
				for($i = 0; $i < count($inst); $i++)
				{
					
					echo '<option value="'.$id_ue[$i].'" '.(($_POST['ue']==$id_ue[$i]||$id_ue[$i]==$func_inst[0] && !isset($_POST['calendario']))?'selected="selected"':"").'>'.$inst[$i].'</option>';

				}

                echo "</select>
			</div>";}
				?> 
			
			<div class="form-group col-md-4">
				Filtrar por calendário:
				<select name="calendario" class="form-control " id="reactive" action="post" onchange='this.form.submit()';>
                <option value="none">----------------</option>
				<?php 
				for($i = 0; $i < count($ids); $i++)
				{
					
					echo '<option value="'.$ids[$i].'" '.(($_POST['calendario']==$ids[$i]||$ids[$i]==$func_cal[0] && !isset($_POST['calendario']))?'selected="selected"':"").'>'.$ids[$i].'</option>';
					

				}

				
				echo "</select>
			</div>";
            ?> 

            <div class="form-group col-md-4">
                    Versão:
                    <select name="versao" class="form-control " action="post" onchange='formreact(this.value,"versao")';>
                    <?php 
                    for($i = 1; $i < $versao; $i++)
                    {
                            
                            echo '<option value="'.$i.'" '.(($i == $versao)?'selected="selected"':"").'>'.$i.'</option>';
        
                        }
                    echo '<option value="recent_ver" selected>'.$versao.'</option>';
                    echo "</select>
                </div>";

        echo "</div>";
	echo "</form>";





// armazena dias invalidos
$invday = mysqli_query($con, "with recursive date_ranges AS (SELECT '".date("Y")."-01-01' dt UNION ALL SELECT dt + INTERVAL 1 DAY FROM date_ranges WHERE dt + INTERVAL 1 DAY <= '".date("Y")."-12-31') SELECT  EXTRACT(DAY FROM dt) AS d_eve_inv, EXTRACT(MONTH FROM dt) AS m_eve_inv, EXTRACT(DAY FROM LAST_DAY(dt)) AS fim_mes FROM date_ranges WHERE DAYNAME(dt) = 'Sunday';");

$simb = array();
$eve = array();
$leg_use = array();

if(!empty($daysql)){
while(($row = mysqli_fetch_array($daysql)) || ($row_tmp = mysqli_fetch_array($daytmp_sql))){
    //adiciona eventos
    if(!empty($row) && !in_array($row['id_evento'], $edits)){
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
                $simb[$m_ini][$d_ini] = ((empty($leg["simbolo_leg"]))?"<a>".$leg["sigla_leg"]."</a>":"<img src='".$leg["simbolo_leg"]."' class='simbico' alt=''>");
            }
        }
        else{
            if ($d_ini >= $d_fim && $m_ini < $m_fim) {
            if ($d_ini <= 32) {
                $eve[$m_ini][$d_ini] = "style='background-color:".$leg['cor_leg'].";' data-toggle='tooltip' data-placement='top' title='".$leg['tipo_evento']."'";
                $simb[$m_ini][$d_ini] = ((empty($leg["simbolo_leg"]))?"<a>".$leg["sigla_leg"]."</a>":"<img src='".$leg["simbolo_leg"]."' class='simbico' alt=''>");
                $d_ini++;
                // se o mes inicial for menor ou igual ao mes final e o dia final for 32(máximo), reinicia o valor do dia inicial para um, voltando ao loop acima, e aumenta em um o valor do mes inicial, até satisfazer o mes inicial
                
                for ($d_fim; $d_fim >= 1; $d_fim--) { 
                        $eve[$m_fim][$d_fim] = "style='background-color:".$leg['cor_leg'].";' data-toggle='tooltip' data-placement='top' title='".$leg['tipo_evento']."'";
                        $simb[$m_fim][$d_fim] = ((empty($leg["simbolo_leg"]))?"<a>".$leg["sigla_leg"]."</a>":"<img src='".$leg["simbolo_leg"]."' class='simbico' alt=''>");
                    }
                } else {
                    $eve[$m_ini][$d_ini] = "style='background-color:".$leg['cor_leg'].";' data-toggle='tooltip' data-placement='top' title='".$leg['desc_leg']."'";
                    $simb[$m_ini][$d_ini] = ((empty($leg["simbolo_leg"]))?"<a>".$leg["sigla_leg"]."</a>":"<img src='".$leg["simbolo_leg"]."' class='simbico' alt=''>");


            }
        // se os meses e os dias não estiverem naquela condição, imprime um class vazio
        }
            for ($d_ini; $d_ini < 32; $d_ini++) { 
                $eve[$m_ini][$d_ini] = "style='background-color:".$leg['cor_leg'].";' data-toggle='tooltip' data-placement='top' title='".$leg['tipo_evento']."'";
                $simb[$m_ini][$d_ini] = ((empty($leg["simbolo_leg"]))?"<a>".$leg["sigla_leg"]."</a>":"<img src='".$leg["simbolo_leg"]."' class='simbico' alt=''>");

            }

        }



        $eve[$m_fim][$d_fim] = "style='background-color:".$leg['cor_leg']."; ' data-toggle='tooltip' data-placement='top' title='".$leg['tipo_evento']."'";
        $simb[$m_fim][$d_fim] = ((empty($leg["simbolo_leg"]))?"<a>".$leg["sigla_leg"]."</a>":"<img src='".$leg["simbolo_leg"]."' class='simbico' alt=''>");
    }

    //adiciona eventos temporarios
        if(!empty($row_tmp)){
            $nv_ver = true;
            $m_ini = $row_tmp['m_ini'];
            $d_ini = $row_tmp['d_ini'];
            $m_fim = $row_tmp['m_fim'];
            $d_fim = $row_tmp['d_fim'];
    
            $leg_sql = mysqli_query($con, "select * from legenda where id_leg = ".$row_tmp['id_leg'].";");
            $leg = mysqli_fetch_array($leg_sql);
            array_push($leg_use,$leg[0]);

            if ($d_ini <= $d_fim && $m_ini == $m_fim) {
                for ($d_ini; $d_ini < $d_fim; $d_ini++) { 
                    $eve[$m_ini][$d_ini] = "style='background-color:".$leg['cor_leg'].";' data-toggle='tooltip' data-placement='top' title='".$leg['tipo_evento']."'";
                    $simb[$m_ini][$d_ini] = ((empty($leg["simbolo_leg"]))?"<a>".$leg["sigla_leg"]."</a>":"<img src='".$leg["simbolo_leg"]."' class='simbico' alt=''>");
                }
            }
            else{
                if ($d_ini >= $d_fim && $m_ini < $m_fim) {
                if ($d_ini <= 32) {
                    $eve[$m_ini][$d_ini] = "style='background-color:".$leg['cor_leg'].";' data-toggle='tooltip' data-placement='top' title='".$leg['tipo_evento']."'";
                    $simb[$m_ini][$d_ini] = ((empty($leg["simbolo_leg"]))?"<a>".$leg["sigla_leg"]."</a>":"<img src='".$leg["simbolo_leg"]."' class='simbico' alt=''>");
                    $d_ini++;
                    // se o mes inicial for menor ou igual ao mes final e o dia final for 32(máximo), reinicia o valor do dia inicial para um, voltando ao loop acima, e aumenta em um o valor do mes inicial, até satisfazer o mes inicial
                    
                    for ($d_fim; $d_fim >= 1; $d_fim--) { 
                            $eve[$m_fim][$d_fim] = "style='background-color:".$leg['cor_leg'].";' data-toggle='tooltip' data-placement='top' title='".$leg['tipo_evento']."'";
                            $simb[$m_fim][$d_fim] = ((empty($leg["simbolo_leg"]))?"<a>".$leg["sigla_leg"]."</a>":"<img src='".$leg["simbolo_leg"]."' class='simbico' alt=''>");
                        }
                    } else {
                        $eve[$m_ini][$d_ini] = "style='background-color:".$leg['cor_leg'].";' data-toggle='tooltip' data-placement='top' title='".$leg['desc_leg']."'";
                        $simb[$m_ini][$d_ini] = ((empty($leg["simbolo_leg"]))?"<a>".$leg["sigla_leg"]."</a>":"<img src='".$leg["simbolo_leg"]."' class='simbico' alt=''>");
    
    
                }
            // se os meses e os dias não estiverem naquela condição, imprime um class vazio
            }
                for ($d_ini; $d_ini < 32; $d_ini++) { 
                    $eve[$m_ini][$d_ini] = "style='background-color:".$leg['cor_leg'].";' data-toggle='tooltip' data-placement='top' title='".$leg['tipo_evento']."'";
                    $simb[$m_ini][$d_ini] = ((empty($leg["simbolo_leg"]))?"<a>".$leg["sigla_leg"]."</a>":"<img src='".$leg["simbolo_leg"]."' class='simbico' alt=''>");
    
                }
    
            }
    
    
    
            $eve[$m_fim][$d_fim] = "style='background-color:".$leg['cor_leg']."; ' data-toggle='tooltip' data-placement='top' title='".$leg['tipo_evento']."'";
            $simb[$m_fim][$d_fim] = ((empty($leg["simbolo_leg"]))?"<a>".$leg["sigla_leg"]."</a>":"<img src='".$leg["simbolo_leg"]."' class='simbico' alt=''>");
        }
    }
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
$calendario = "<div style='text-align: -webkit-center;' id='calendario'>";
    // começo do calendário
    $calendario .= "<table class='table table-bordered border border-4 border-warning stripped ' style='border-collapse: collapse;'>";
    $calendario .= "<tr class=''>";
    $calendario .= "<td  rowspan='2' class='cal-content'>Meses</td>";
    $calendario .= "<td colspan='31' class='cal-content'>Dias</td>";
    $calendario .= "<tr>";
    for ($ç=1; $ç < 32; $ç++) { 
        $calendario .= "<td colspan='ç' class='cal-content'>$ç</td>";
    }
    $calendario .= "</tr>";
    $calendario .= "</tr>";

// começa a criar colunas de meses
for ($i=1; $i < 13; $i++) {
    // abre a linha dos meses
    $calendario .= "<tr class='cils' style=''>";
    // abre a coluna dos meses
    $calendario .= "<td class='mis cal-content' style=''>";

    // cria um array para armazenar os meses, o primeiro fica vazio pois dá erro na criação do calendário
    $meses = array("","Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");

    // usa o array, para cada valor ele usa o número da coluna para acessar um valor do array
    foreach ($meses as $a => $value) {
        $calendario .= "<span style='display:flex; justify-content:center;'><strong>".$meses[$i]."</strong></span>";
        break;
    }
    // fecha a linha de meses
    $calendario .= "</td>";

    // tentativa fracassada de repetir o argumento do if else
        // while ($coords = mysqli_fetch_array($daysql)) {

    // começo do argumento
    // enquanto tiver valores no banco de dados, ele imprime o argumento || geralmente cria um ou outro mas me confundi e deixei assim
       
        // começo da repetição dos dias $j
        for ($j=1; $j < 32; $j++) { 
            $calendario .= "<td ";
            if(!empty($eve[$i][$j])){
                $calendario .= $eve[$i][$j];
            }
        $calendario .= " class='cal-content'>".((!empty($simb[$i][$j]))?$simb[$i][$j]:"")."<span class='number' style='display:flex; justify-content:center;'></span></td>";
        }
    
    // condição alternativa do argumento acima, geralmente imprime um ou outro, então é redundante. mas como quem planta verde colhe maduro...
    


}

$calendario .= "</tr>";


$calendario .= "</table>";

echo $calendario;

//Legenda
if(($leg_use) != null){
echo "<br>";
$leg_sql = mysqli_query($con, "select tipo_evento as tipo, desc_leg as descricao, simbolo_leg as simbolo, sigla_leg as sigla, cor_leg as cor from legenda where id_leg IN (" . implode(",", array_map('intval', $leg_use)) . ");");
$sla_sql = mysqli_query($con, "select id_leg from legenda where id_leg IN (" . implode(",", array_map('intval', $leg_use)) . ");");


    $sla= array();
    while ($kkk = mysqli_fetch_array($sla_sql)) {
        $sla[] = $kkk[0];
    }
    echo "<button class='btn btn-info' style='float: right;' onclick=\"formreact(".$versao.",'versao')\">PDF</button><br>";
    echo "Legenda:";
    
    $so = sizeof($sla);
    $i=0;
    $o=0;
    $n=0;
    echo "<div class= 'd-flex flex-row justify-content-center mt-4'>";
    $legenda = "<div class= 'd-flex flex-column justify-content-center mt-4' style='width:50%;'>";
    $legenda .= "Legenda:";
    echo "<table class='table table-bordered table-responsive border border-3 rounded border-warning stripped' id='leg_table' style='justify-content: center !important; overflow:wrap;float:left;'>";
    //$legenda .= "<table class='table table-bordered table-responsive border border-3 rounded border-warning stripped' id='leg_table' style='justify-content: center !important; overflow:wrap;'>";
    $legenda .= "<table class='table table-bordered  border border-2  border-warning stripped' style='overflow:wrap;border-spacing: 5px 0;border-collapse: separate;border-radius:11px;'>";
    while($row = mysqli_fetch_array($leg_sql)){
        //if($i==10){$i=0;}
        //if($i==0){ echo "<table class='table table-bordered table-responsive border border-3 rounded border-warning stripped' style='height:30vh !important; width:45% !important; justify-content: center !important; '>";}
        if($i==4){$i=0;}
        if($i==0){ echo "<tr  style='line-height: 25px;min-height: 25px;' >";}
        echo "<td data-toggle='tooltip' data-placement='right' title='".$row['descricao']."' class='mis cal-content' style='background-color:".$row['cor'].";".(($i == 0)?"margin-right:100px;":"")."'><img src='".$row["simbolo"]."' class='simbico' style='width=0%'>".$row['sigla'];
        //$legenda .= "<td class='mis cal-content' style='background-color:".$row['cor'].";".(($i == 0)?"margin-right:100px;":"")."'><img src='".$row["simbolo"]."' class='simbico' style='width=0%'>".$row['sigla'];
        echo "<td data-toggle='tooltip' data-placement='right' title='".$row['descricao']."' class='mis cal-content'>".$row['tipo']."</td>";
        //$legenda .= "<td class='mis cal-content'>".$row['descricao']."</td>";
        if($i==4||$o==$so){echo "</tr>";}
        //$legenda .= "</tr>";} 
        //if($i==10||$o==$so){echo "</table>";} 
        $i++;
        $o++;
        
        

        if($n==2){$n=0;};
        if($n==0){$legenda .= "<tr style='line-height: 25px;min-height: 25px;height: 1px ;'>";}
        $legenda .= "<td class='mis cal-content' style='background-color:".$row['cor'].";margin-left:10px'>
        ".((empty($row["simbolo"]))?"":"<img src='".$row["simbolo"]."' class='simbico' alt=''>")."
        ".$row['sigla']."</td>";
        $legenda .= "<td class='mis cal-content'>".$row['tipo']."</td>";

        if($n==1||$o==$so){$legenda .= "</tr>";}
        
        $n++;
    }
    echo "</table>";
    $legenda .= "</table>";

    echo "</div>";
    $legenda .= "</div>";
}

if(!empty($ano_sql)){

$ue_sql = mysqli_query($con, "select nome_ue, logo_ue, sigla_ue from ue where id_ue = '".$ue."';");
while($row = mysqli_fetch_array($ue_sql))
	{
		$nome_ue = $row[0];
        $logo_ue = $row[1];
        $sigla_ue = $row[2];
	}

unset($_SESSION['calendario']);
unset($_SESSION['ano']);
unset($_SESSION['ue']);
unset($_SESSION['logo_ue']);
unset($_SESSION['sigla_ue']);
unset($_SESSION['legenda']);
$_SESSION['calendario'] = $calendario;
$_SESSION['ano'] = $ano;
$_SESSION['ue'] = $nome_ue;
$_SESSION['logo_ue'] = $logo_ue;
$_SESSION['sigla_ue'] = $sigla_ue;
$_SESSION['versao_ue'] = $versao;

if(!empty($edits) || !empty($nv_ver)){
    echo "<div style='display:flex; justify-content:space-between;text-decoration:none'>";
    if(isset($_POST['calendario']) && $_POST['calendario'] !== 'none'){
    echo "<a href='based/cancel.php?cal=".$_POST['calendario']."' ><button class='btn btn-danger'>Cancelar mudanças feitas</button></a>";
    echo "<a href='based/salvar.php?cal=".$_POST['calendario']."''><button class='btn btn-primary'>Publicar nova versão</button></a>";}
    else if(!empty($func_cal[0])){
        echo "<a href='based/cancel.php?cal=".$func_cal[0]."' ><button class='btn btn-danger'>Cancelar mudanças feitas</button></a>";
        echo "<a href='based/salvar.php?cal=".$func_cal[0]."''><button class='btn btn-primary'>Publicar nova versão</button></a>";
    }
    echo "</div>";}
}
echo "</div>";
echo "<div id='pdf_versao' style='text-align: -webkit-center;'>";
echo "</div>";
echo "<button class='btn btn-info' style='float: right;display:none' onclick=\"formreact('recent_ver','versao')\" id='recent_button'>Voltar para o calendário</button><br>";
if(($leg_use) != null){
$_SESSION['legenda'] = $legenda;}
?>