<?php
$con = mysqli_connect('localhost', 'root', '', 'dailyevent');
if($_GET['ue'] == "none"){
$id_cal = mysqli_query($con, "select id_calendario from calendario ORDER BY id_calendario ASC") or die(mysqli_error());}
else{
$id_cal = mysqli_query($con, "select id_calendario from calendario where id_ue = '".$_GET['ue']."' ORDER BY id_calendario ASC") or die(mysqli_error());}
$ids = array();
	while($row = mysqli_fetch_array($id_cal))
	{
		$ids[] = $row['id_calendario'];
	}

	echo "<option value='none'>Todos</option>";
	for($i = 0; $i < count($ids); $i++)
	{
		
		echo '<option value="'.$ids[$i].'" '.(($_POST['calendario']==$ids[$i])?'selected="selected"':"").'>'.$ids[$i].'</option>';
		

	}

	 
	
?>