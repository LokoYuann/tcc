<?php
$con = mysqli_connect('localhost', 'root', '', 'dailyevent');

//Eventos
if($_GET['page'] == "lista_eve" || $_GET['page'] == "calendario"){
if($_GET['value'] == "none"){
$id_cal = mysqli_query($con, "select id_calendario from calendario ORDER BY id_calendario ASC") or die(mysqli_error());}
else{
$id_cal = mysqli_query($con, "select id_calendario from calendario where id_ue = '".$_GET['value']."' ORDER BY id_calendario ASC") or die(mysqli_error());}
$ids = array();
	while($row = mysqli_fetch_array($id_cal))
	{
		$ids[] = $row['id_calendario'];
	}

	if($_GET['page'] == "lista_eve"){echo "<option value='none'>Todos</option>";}
	for($i = 0; $i < count($ids); $i++)
	{
		
		echo '<option value="'.$ids[$i].'" '.(($_POST['calendario']==$ids[$i])?'selected="selected"':"").'>'.$ids[$i].'</option>';
		

	}
}
	 
//simbolo

elseif($_GET['page'] == "addleg"){
	echo '<i class="fa '.$_GET['value'].'" style="font-size:190%;display:flex; justify-content:center;"></i>
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
		Mudar
	</button>';
}
?>