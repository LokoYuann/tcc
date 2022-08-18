<?php
	//Estabelece conexão com o banco de dados em uma variavel
	$con = mysqli_connect('localhost', 'root', '', 'dailyevent');
	//Pega todos os tipos de eventos do banco de dados
	$events_sql = mysqli_query($con, "select id_leg, tipo_evento from legenda ORDER BY id_leg ASC") or die(mysqli_error());
	//Pega todos as instituições do banco de dados
	$inst_sql = mysqli_query($con, "select id_ue, sigla_ue from ue ORDER BY id_ue ASC") or die(mysqli_error());
	//Descobre a instituição do funcionário logado
	$func_inst_sql = mysqli_query($con, "select id_ue from funcionario where mat_func = '".$_SESSION['UsuarioID']."'") or die(mysqli_error());
	$func_inst = mysqli_fetch_array($func_inst_sql);
	//Descobre calendarios da insituição do funcionário
	$func_cal_sql = mysqli_query($con, "select id_calendario from calendario where id_ue = '".$func_inst[0]."'") or die(mysqli_error());
	$func_cal = mysqli_fetch_array($func_cal_sql);

	//Arrays contendo devidas informações
	$id_ue= array();
	$inst= array();
	$tipo_evento= array();
	$id_leg= array();

	//Inserem todos os valores recebidos pelo SQL em seus arrays
	while($row = mysqli_fetch_array($events_sql))
	{
	$id_leg[] = $row['id_leg'];
	$tipo_evento[] = $row['tipo_evento'];
	}
	
	while($row = mysqli_fetch_array($inst_sql))
	{
	$id_ue[] = $row['id_ue'];
	$inst[] = $row['sigla_ue'];
	}
?>