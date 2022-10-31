<?php
$con = mysqli_connect('localhost', 'root', '', 'dailyevent');

//Eventos
if($_GET['page'] == "lista_eve" || $_GET['page'] == "calendario"|| $_GET['page'] == "addeve"){
if($_GET['value'] == "none"){
$id_cal = mysqli_query($con, "select id_calendario, ano_letivo from calendario ORDER BY id_calendario ASC") or die(mysqli_error());}
else{
$id_cal = mysqli_query($con, "select id_calendario, ano_letivo from calendario where id_ue = '".$_GET['value']."' ORDER BY id_calendario ASC") or die(mysqli_error());}
$ids = array();
	while($row = mysqli_fetch_array($id_cal))
	{
		$ids[] = $row['id_calendario'];
		$ano[] = $row['ano_letivo'];
	}

	echo "<option value='none'>".(($_GET['page'] == "lista_eve")?"Todos":"----------------")."</option>";
	for($i = 0; $i < count($ids); $i++)
	{
		
		echo '<option value="'.$ids[$i].'" '.(($_POST['calendario']==$ids[$i])?'selected="selected"':"").'>'.$ano[$i].'</option>';
		

	}
}
	 
//simbolo

elseif($_GET['page'] == "addleg"){
	echo '<img src="/admin/static/img/simbolos/'.$_GET['value'].'" class="simbico_leg_edit" alt="">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
		Mudar
	</button>';
}
elseif($_GET['page'] == "versao"){
	if(!isset($_SESSION)) session_start();
	echo '<embed src="/admin/static/img/versao/'.$_SESSION['sigla_ue'].'/'.$_SESSION['ano'].'/'.$_SESSION['sigla_ue'].' - '.$_SESSION['ano'].' v'.$_GET['value'].'.pdf" width="1000px" height="770px"  />';

}

elseif($_GET['page'] == "cal_mes"){
	$mes = $_GET['value'];
	$count = 0;
	$o = 0;
	$sla_sql = mysqli_query($con, "select id_leg, EXTRACT(DAY FROM dt_ini_ev) AS d_ini, EXTRACT(DAY FROM dt_fim_ev) AS d_fim, EXTRACT(MONTH FROM dt_ini_ev) AS m_ini, EXTRACT(MONTH FROM dt_fim_ev) AS m_fim, id_evento from eventos where id_calendario = '".$_GET['calendario']."' and EXTRACT(MONTH FROM dt_ini_ev) = '".$mes."' order by dt_ini_ev ;");
	
$sla = mysqli_fetch_array($sla_sql);
	$so = sizeof($sla);

	echo $so;
	exit;
	for ($i=0; $i <= 31; $i++) { 
		if($count==7){$count=0;}
        if($count==0){ echo "<tr  style='line-height: 25px;min-height: 25px;' >";}

		if($count==7||$o==$so){echo "</tr>";}
		
		$count++;
		$o++;
	}
}

?>