<?php
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}


if(!empty($_GET['calendario'])){
    $_POST['calendario'] = $_GET['calendario'];
    $_POST['ue'] = $_GET['ue'];
}
	if($_SESSION['UsuarioNivel'] == 2){
		if(isset($_POST['ue']) && $_POST['ue'] !== 'none'){
			$id_cal = mysqli_query($con, "select id_calendario,ano_letivo, id_ue from calendario where id_ue = '".$_POST['ue']."' ORDER BY id_calendario ASC") or die(mysqli_error());}
		else if(isset($_POST['ue']) && $_POST['ue'] == 'none'){
			$id_cal = mysqli_query($con, "select id_calendario,ano_letivo, id_ue from calendario  ORDER BY id_calendario ASC") or die(mysqli_error());}
        else{
            $id_cal = mysqli_query($con, "select id_calendario,ano_letivo, id_ue from calendario where id_ue = '".$func['id_ue']."' ORDER BY id_calendario ASC") or die(mysqli_error());
        }
        }
	else{
		$id_cal = mysqli_query($con, "select id_calendario,ano_letivo, id_ue from calendario where id_ue = '".$func['id_ue']."' ORDER BY id_calendario ASC") or die(mysqli_error());}
        while($row = mysqli_fetch_array($id_cal))
        {
            $ids[] = $row['id_calendario'];
            $ano_sel[] = $row['ano_letivo'];
            $sig_sql = mysqli_query($con, "select sigla_ue from ue where id_ue = '".$row['id_ue']."' ") or die(mysqli_error());
            $sig[] = mysqli_fetch_array($sig_sql)[0]; 
        }



        unset($_SESSION['cal_atual']);
        if(isset($_POST['calendario']) && $_POST['calendario'] !== 'none'){
        // cria outra conexão com o banco de dados, onde ele chama os dados com nomes mais fáceis para fazer o X e o Y da tabela
            $daysql = mysqli_query($con, "(SELECT id_leg, EXTRACT(DAY FROM dt_ini_ev) AS d_ini, EXTRACT(DAY FROM dt_fim_ev) AS d_fim, EXTRACT(MONTH FROM dt_ini_ev) AS m_ini, EXTRACT(MONTH FROM dt_fim_ev) AS m_fim, id_evento, null as act_tmp,dt_ini_ev as data_ini, dt_fim_ev as data_fim FROM eventos WHERE id_calendario='".$_POST['calendario']."' && id_evento not in (SELECT id_evento  FROM tmp_eve) union all SELECT id_leg, EXTRACT(DAY FROM dt_ini_tmp) AS d_ini, EXTRACT(DAY FROM dt_fim_tmp) AS d_fim, EXTRACT(MONTH FROM dt_ini_tmp) AS m_ini, EXTRACT(MONTH FROM dt_fim_tmp) AS m_fim, id_evento, act_tmp,dt_ini_tmp as data_ini, dt_fim_tmp as data_fim  FROM tmp_eve wHERE id_calendario ='".$_POST['calendario']."') order by data_ini");

            $ano_sql = mysqli_query($con, "select ano_letivo, id_ue, versao_cal from calendario where id_calendario = '".$_POST['calendario']."';");
            $_SESSION['cal_atual'] = $_POST['calendario'];
        }

        else if(!empty($func['cal'])){
            $daysql = mysqli_query($con, "(SELECT id_leg, EXTRACT(DAY FROM dt_ini_ev) AS d_ini, EXTRACT(DAY FROM dt_fim_ev) AS d_fim, EXTRACT(MONTH FROM dt_ini_ev) AS m_ini, EXTRACT(MONTH FROM dt_fim_ev) AS m_fim, id_evento, null as act_tmp,dt_ini_ev as data_ini, dt_fim_ev as data_fim FROM eventos WHERE id_calendario='".$func['cal']."' && id_evento not in (SELECT id_evento  FROM tmp_eve) union all SELECT id_leg, EXTRACT(DAY FROM dt_ini_tmp) AS d_ini, EXTRACT(DAY FROM dt_fim_tmp) AS d_fim, EXTRACT(MONTH FROM dt_ini_tmp) AS m_ini, EXTRACT(MONTH FROM dt_fim_tmp) AS m_fim, id_evento, act_tmp,dt_ini_tmp as data_ini, dt_fim_tmp as data_fim  FROM tmp_eve wHERE id_calendario ='".$func['cal']."') order by data_ini");
            $ano_sql = mysqli_query($con, "select ano_letivo, id_ue, versao_cal from calendario where id_calendario = '".$func['cal']."';");
            $_SESSION['cal_atual'] = $func['cal'];
        }

        
        if(!empty($ano_sql)){
            while($row = mysqli_fetch_array($ano_sql))
                {
                    $ano = $row[0];
                    $ue = $row[1];
                    $versao = $row[2];
                }
            
                $ue_sql = mysqli_query($con, "select nome_ue, logo_ue, sigla_ue from ue where id_ue = '".$ue."';");
                while($row = mysqli_fetch_array($ue_sql))
                    {
                        $nome_ue = $row[0];
                        $logo_ue = $row[1];
                        $sigla_ue = $row[2];
                    }
                
                
                unset($_SESSION['ano']);
                unset($_SESSION['ue']);
                unset($_SESSION['logo_ue']);
                unset($_SESSION['sigla_ue']);
                unset($_SESSION['legenda']);
                
                $_SESSION['ano'] = $ano;
                $_SESSION['ue'] = $nome_ue;
                $_SESSION['logo_ue'] = $logo_ue;
                $_SESSION['sigla_ue'] = $sigla_ue;
                $_SESSION['versao_ue'] = $versao;
            }
?>

<form action="?page=home" method="post" >
		<div class="d-flex row justify-content-left" > 
        <?php if($_SESSION['UsuarioNivel'] == 2){ ?>
			<div class="form-group col-md-4">
				Instituição:
				<select name="ue" class="form-control " action="post" onchange='formreact(this.value,"calendario")';>
				<?php 
				for($i = 0; $i < count($inst); $i++)
				{
					
					echo '<option value="'.$id_ue[$i].'" '.(($_POST['ue']==$id_ue[$i]||$id_ue[$i]==$func['id_ue'] && !isset($_POST['calendario']))?'selected="selected"':"").'>'.$inst[$i].'</option>';

				}

                echo "</select>
			</div>";}
				?> 
			
			<div class="form-group col-md-4">
				Calendário:
				<select name="calendario" class="form-control " id="reactive" action="post" onchange='this.form.submit()';>
                <option value="none">----------------</option>
				<?php 
				for($i = 0; $i < count($ids); $i++)
				{
					
					echo '<option value="'.$ids[$i].'" '.(($_POST['calendario']==$ids[$i]||$ids[$i]==$func['cal'] && !isset($_POST['calendario']))?'selected':"").'>'.$ano_sel[$i].'</option>';
					

				}

				
				echo "</select>
			</div>";
            ?> 

            <div class="form-group col-md-4">
                    Versão:
                    <?php 
                    $arroz = '/admin/static/img/versao/'.$sigla_ue.'/'.$ano.'/'.$sigla_ue.' - '.$ano.' v';
                    echo "<select name='versao' class='form-control ' action='post' onchange='arroz(\"".$arroz."\", this.value, ".$versao.")'>";
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

$calendario_lis = "</tr>";
if(!empty($daysql)){
while(($row = mysqli_fetch_array($daysql))){
    if(!empty($row['act_tmp']) && !empty($row['act_tmp']) != null){$nv_ver = true;}
    //adiciona eventos
    if($row['act_tmp'] != 'del'){
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



        $week_ini = date("w", strtotime($row['data_ini']));
    $week_fim = date("w", strtotime($row['data_fim']));

    $calendario_lis .= "<tr>";
    $calendario_lis .= "<td style='text-align: center;'>".$meses[$row['m_ini']]."</td>";
    $calendario_lis .= "<td style='text-align: center;'>".$row['d_ini']."/".$row['m_ini']."</td>";
    $calendario_lis .= "<td style='text-align: center;' class='d-none d-sm-table-cell'>".$dias[$week_ini]."</td>";
    $calendario_lis .= "<td style='text-align: center;'>".$row['d_fim']."/".$row['m_fim']."</td>";
    $calendario_lis .= "<td style='text-align: center;' class='d-none d-sm-table-cell'>".$dias[$week_fim]."</td>";
    $calendario_lis .= "<td >".$leg['tipo_evento']."</td>";

    $calendario_lis .= "</tr>";
    }
    }

   
    }
$calendario_lis .= "</table>";
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


// começo do calendário
echo "<div id='calendario'>";
$calendario = "<div style='text-align: -webkit-center;display:".((isMobile())?"none":"block").";' id='cal_esc'>";
if($ano == date("Y")){
    $calendario .= "<table class='table table-bordered border border-3 border-warning stripped ' style='border-collapse: collapse;'>";
    $calendario .= "<tr class=''>";
    $calendario .= "<td  rowspan='2' class='cal-content cal-cab'>Meses</td>";
    $calendario .= "<td colspan='31' class='cal-content'>Dias</td>";
    $calendario .= "<tr>";
    for ($ç=1; $ç < 32; $ç++) { 
        $calendario .= "<td colspan='ç' class='cal-content cal-cab'>$ç</td>";
    }
    $calendario .= "</tr>";
    $calendario .= "</tr>";

// começa a criar colunas de meses
for ($i=1; $i < 13; $i++) {
    // abre a linha dos meses
    $calendario .= "<tr class='cils' style=''>";
    // abre a coluna dos meses
    $calendario .= "<td class='mis cal-content meses' >";

    

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

    echo "Legenda:";
    
    $so = sizeof($sla);
    $i=0;
    $o=0;
    $n=0;
    echo "<div class= 'd-flex flex-row justify-content-center mt-4'>";
    $legenda = "<div class= 'd-flex flex-column justify-content-center mt-4' style='width:50%;' id='leg_table'>";
    $legenda .= "Legenda:";
    echo "<table class='table table-bordered table-responsive border border-3 rounded border-warning stripped' id='leg_table' style='justify-content: center !important; overflow:wrap;float:left;'>";
    //$legenda .= "<table class='table table-bordered table-responsive border border-3 rounded border-warning stripped' id='leg_table' style='justify-content: center !important; overflow:wrap;'>";
    $legenda .= "<table class='table table-bordered  border border-1  border-warning stripped' style='overflow:wrap;border-spacing: 5px 0;border-collapse: collapse;border-radius:11px;'>";
    while($row = mysqli_fetch_array($leg_sql)){
        //if($i==10){$i=0;}
        //if($i==0){ echo "<table class='table table-bordered table-responsive border border-3 rounded border-warning stripped' style='height:30vh !important; width:45% !important; justify-content: center !important; '>";}
        if($i==4){$i=0;}
        if($i==0){ echo "<tr  style='line-height: 25px;min-height: 25px;' >";}
        echo "<td data-toggle='tooltip' data-placement='right' title='".$row['descricao']."' class='mis ' style='background-color:".$row['cor'].";".(($i == 0)?"margin-right:100px;":"")."text-align:center;min-width: 60px;'><img src='".$row["simbolo"]."' class='simbico' ><br>".$row['sigla'];
        //$legenda .= "<td class='mis cal-content' style='background-color:".$row['cor'].";".(($i == 0)?"margin-right:100px;":"")."'><img src='".$row["simbolo"]."' class='simbico' style='width=0%'>".$row['sigla'];
        echo "<td data-toggle='tooltip' data-placement='right' title='".$row['descricao']."' class='mis ' >".$row['tipo']."</td>";
        //$legenda .= "<td class='mis cal-content'>".$row['descricao']."</td>";
        if($i==4||$o==$so){echo "</tr>";}
        //$legenda .= "</tr>";} 
        //if($i==10||$o==$so){echo "</table>";} 
        $i++;
        $o++;
        
        

        if($n==4){$n=0;};
        if($n==0){$legenda .= "<tr style='line-height: 25px;min-height: 25px;height: 1px ;border-bottom: 1px solid;'>";}
        $legenda .= "<td class='mis ' style='text-align:center;background-color:".$row['cor'].";margin-left:10px;text-align:center'>
        ".((empty($row["simbolo"]))?"":"<img src='".$row["simbolo"]."' class='simbico' alt=''><br>")."
        ".$row['sigla']."</td>";
        $legenda .= "<td class='mis ' id='leg'>".$row['tipo']."</td>";

        if($n==1||$o==$so){$legenda .= "</tr>";}
        
        $n++;
    }
    echo "</table>";
    $legenda .= "</table>";

    echo "</div>";
    $legenda .= "</div>";
}}


if($ano < date("Y")){
    echo "<div style='text-align: -webkit-center;' id='calendario'>";
    echo '<embed src="/admin/static/img/versao/'.$sigla_ue.'/'.$ano.'/'.$sigla_ue.' - '.$ano.' v'.$versao.'.pdf" width="1000px" height="770px" ></embed>';
}
echo "</div>";

echo "<div id='cal_lis' style='text-align: -webkit-center;display:".((isMobile())?"block":"none").";'>";
echo "<table class='table table-bordered table-responsive border border-4 stripped' id='list_cal' >";
echo "<tr>";
echo "<td style='text-align: center;'>Mês</td>";
echo "<td colspan='2' style='text-align: center;' class='d-none d-sm-table-cell'>Data de início</td>";
echo "<td colspan='2' style='text-align: center;' class='d-none d-sm-table-cell'>Data de fim</td>";
echo "<td style='text-align: center;' class='d-table-cell d-sm-none'>Início</td>";
echo "<td style='text-align: center;' class='d-table-cell d-sm-none'>Fim</td>";
echo "<td style='text-align: center;'>Legenda</td>";

echo $calendario_lis;
echo "</div>";

echo "</div>";
echo "<div id='pdf' style='display:none'>";
echo "<div id='pdf_versao_esc' style='text-align: -webkit-center; display:block'>";
echo '<embed src="/admin/static/img/versao/'.$sigla_ue.'/'.$ano.'/'.$sigla_ue.' - '.$ano.' v'.$versao.' - esc.pdf" width="1000px" height="770px" ></embed>';
echo "</div>";
echo "<div id='pdf_versao_acad' style='text-align: -webkit-center; display:none'>";
echo '<embed src="/admin/static/img/versao/'.$sigla_ue.'/'.$ano.'/'.$sigla_ue.' - '.$ano.' v'.$versao.' - acad.pdf" width="1000px" height="770px" ></embed>';
echo "</div>";
echo "</div>";

echo "<div style='display:flex;flex-direction:row;text-decoration:none;justify-content:space-between;'>";
echo "<div style='display:flex;flex-direction:column;'>";
echo "<button class='btn btn-info' style='margin-bottom:10px;width:175px' onclick=\"tipoCal()\">Alternar calendário</button><br>";
echo "<button class='btn btn-info' style='width:175px' onclick=\"Pdf()\" id='button_pdf'>PDF</button>";
echo "<button class='btn btn-info' style='display:none;width:175px' onclick=\"Pdf()\" id='recent_button'>Voltar ao calendário</button><br>";
echo "</div>";
if(!empty($ano_sql)){

    if(!empty($nv_ver)){
        echo "<div style='display:flex;flex-direction:column;margin-right:10px' id='nv_button'>";
        if(isset($_POST['calendario']) && $_POST['calendario'] !== 'none'){
            echo "<a href='based/salvar.php?cal=".$_POST['calendario']."' style='width:175px;'><button class='btn btn-primary' style='margin-bottom:10px;width:175px'>Publicar nova versão</button></a><br>";
            echo "<a href='based/cancel.php?cal=".$_POST['calendario']."' style='width:175px;'><button class='btn btn-danger' style='width:175px'>Cancelar mudanças</button></a>";
        }
        else if(!empty($func['cal'])){
            echo "<a href='based/salvar.php?cal=".$func['cal']."' style='width:175px;'><button class='btn btn-primary' style='margin-bottom:10px;width:175px'>Publicar nova versão</button></a><br>";
            echo "<a href='based/cancel.php?cal=".$func['cal']."' style='width:175px;'><button class='btn btn-danger' style='width:175px'>Cancelar mudanças</button></a>";
        }
        echo "</div>";}
}
echo "</div>";

unset($_SESSION['calendario_lis']);
unset($_SESSION['legenda']);
if($calendario_lis != null){
    $_SESSION['calendario_lis'] = $calendario_lis;}
if(($leg_use) != null && !empty($legenda)){
    $_SESSION['legenda'] = $legenda;}
unset($_SESSION['calendario']);
$_SESSION['calendario'] = $calendario;
?>