<?php

$dt_ini_ev      = $_POST["dt_ini_ev"];
$dt_fim_ev      = $_POST["dt_fim_ev"];
$id_calendario   = $_POST["id_calendario"];
$id_leg          = $_POST["id_leg"];
$id_ue          = $_POST["id_ue"];

echo $id_leg[1];exit;
if($id_calendario == "novo_cal"){
$sql_cal = mysqli_query($con, "insert into calendario values ('','".date('Y',strtotime($dt_fim_ev))."','".$id_ue."','".date("y/m/d")."','0')");
$sql_nv = mysqli_query($con, "select id_calendario from calendario where versao_cal = '0' && id_ue = '".$id_ue."'");
$id_calendario = mysqli_fetch_array($sql_nv)[0];
}
$sql_base = mysqli_query($con, "select dt_ini_ev as data_ini, dt_fim_ev as data_fim from eventos where id_calendario='0' && id_leg = '".$id_leg."'");
$base = mysqli_fetch_array($sql_base);
if((mysqli_num_rows($sql_base) != 0) && ($dt_ini_ev < $base['data_ini']||$dt_ini_ev > $base['data_fim']||$dt_fim_ev < $base['data_ini']||$dt_fim_ev > $base['data_fim'])){
    header('Location: dash.php?page=addeve&msg=6');exit;
}
foreach($_POST['id_leg'] as $key => $value){
    $sql = "insert into tmp_eve values ";
    $sql .= "('','$dt_ini_ev','$dt_fim_ev','$id_calendario','$id_leg','add','0');";
    $stmt = $con;
}
    
    
    $resultado = mysqli_query($con, $sql);
    if($resultado){
        header('Location: dash.php?page=lista_eve&msg=1');
        mysqli_close($con);
    }else{
        header('Location: dash.php?page=lista_eve&msg=4');
        mysqli_close($con);
    }
?>