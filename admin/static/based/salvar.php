<?php
$con = mysqli_connect('localhost', 'root', '', 'dailyevent');
$sql_tmp = mysqli_query($con, "select * from tmp_eve where id_calendario = '".$_GET['cal']."'");

while($row = mysqli_fetch_array($sql_tmp)){
    if($row['act_tmp'] == 'add'){
        $sql = "insert into eventos values ";
        $sql .= "('0','".$row['dt_ini_tmp']."','".$row['dt_fim_tmp']."','".$row['id_calendario']."','".$row['id_leg']."');";
    }
    elseif($row['act_tmp'] == 'edit'){
        $sql = "update eventos set ";
        $sql .= "dt_ini_ev ='".$row['dt_ini_tmp']."', dt_fim_ev='".$row['dt_fim_tmp']."', id_calendario='".$row['id_calendario']."',";
        $sql .= "id_leg='".$row['id_leg']."'";
        $sql .= " where id_evento = '".$row['id_evento']."';";
    }
    else{
        $sql = "delete from eventos where id_evento = '".$row['id_evento']."';"; 
    }

    $resultado = mysqli_query($con, $sql)or die(mysqli_error());
    
}
$sql_del = "delete from tmp_eve where id_calendario = '".$_GET['cal']."';"; 
$resultado = mysqli_query($con, $sql_del)or die(mysqli_error());

$sql_ver = mysqli_query($con, "select versao_cal from calendario where id_calendario = '".$_GET['cal']."';")or die(mysqli_error());
$ver = mysqli_fetch_array($sql_ver)[0]+1; 
$update = mysqli_query($con, "update calendario set versao_cal = '".$ver."' where id_calendario='".$_GET['cal']."'")or die(mysqli_error());


header('Location: /admin/static/mpdf.php?value=nova_versao&versao='.$ver.'');
?>