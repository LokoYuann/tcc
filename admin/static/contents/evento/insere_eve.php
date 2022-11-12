<?php

$dt_ini_ev      = $_POST["dt_ini_ev"];
$dt_fim_ev      = $_POST["dt_fim_ev"];
$id_calendario   = $_POST["id_calendario"];
$id_leg          = $_POST["id_leg"];

    // $fdt_nasc 	= implode("-", array_reverse(explode("/", $dt_nasc)));
    $sql = "insert into tmp_eve values ";
    $sql .= "('','$dt_ini_ev','$dt_fim_ev','$id_calendario','$id_leg','add','0');";
    
    
    $resultado = mysqli_query($con, $sql);
    if($resultado){
        header('Location: dash.php?page=lista_eve&msg=1');
        mysqli_close($con);
    }else{
        header('Location: dash.php?page=lista_eve&msg=4');
        mysqli_close($con);
    }
?>