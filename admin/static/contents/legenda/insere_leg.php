<?php

$tipo_evento      = $_POST["tipo_evento"];
$desc_leg      = $_POST["desc_leg"];
$simbolo_leg   = $_POST["simbolo_leg"];
$sigla_leg   = $_POST["sigla_leg"];
$cor_leg   = $_POST["cor_leg"];

   $sql = "insert into legenda values ";
    $sql .= "('0','$tipo_evento','$desc_leg','$simbolo_leg','$sigla_leg','$cor_leg');";
    
    
    $resultado = mysqli_query($con, $sql)or die(mysqli_error());

    if($resultado){
        header('Location: dash.php?page=lista_leg&msg=1');
        mysqli_close($con);
    }else{
        header('Location: dash.php?page=lista_leg&msg=4');
        mysqli_close($con);
    }
?>