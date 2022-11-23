<?php
$con = mysqli_connect('localhost', 'root', '', 'dailyevent');

$id_cal = mysqli_query($con, "select dt_ini_ev as data_ini,dt_fim_ev as data_fim from eventos where id_calendario = '0' && id_leg='".$_GET['id_leg']."';") or die(mysqli_error());
$row = mysqli_fetch_array($id_cal);
if(mysqli_num_rows($id_cal) != 0){
    if($_GET['num'] == 1){
        echo $row['data_ini'];
    } else{
        echo $row['data_fim'];
    }
}


?>