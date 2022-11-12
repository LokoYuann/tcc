<?php
$con = mysqli_connect('localhost', 'root', '', 'dailyevent');

//Eventos
if($_GET['value'] == "none"){
$id_cal = mysqli_query($con, "select id_calendario, ano_letivo, (select sigla_ue from ue where calendario.id_ue = ue.id_ue) as sigla from calendario ORDER BY id_calendario ASC") or die(mysqli_error());}
else{
$id_cal = mysqli_query($con, "select id_calendario, ano_letivo, (select sigla_ue from ue where calendario.id_ue = ue.id_ue) as sigla from calendario where id_ue = '".$_GET['value']."' ORDER BY id_calendario ASC") or die(mysqli_error());}
	while($row = mysqli_fetch_array($id_cal))
	{
		$ids[] = $row['id_calendario'];
		$ano[] = $row['ano_letivo'];
		$sigla[] = $row['sigla'];
	}

	echo "<option value='none'>".(($_GET['page'] == "lista_eve")?"Todos":"----------------")."</option>";
	for($i = 0; $i < count($ids); $i++)
	{
		
		echo '<option value="'.$ids[$i].'" '.(($_POST['calendario']==$ids[$i])?'selected="selected"':"").'>'.(($_GET['value'] == "none")? $sigla[$i].' - ':"").$ano[$i].'</option>';
		

	}


?>