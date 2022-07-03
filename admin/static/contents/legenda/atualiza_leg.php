<?php
    $id_leg		  = $_POST["id_leg"];
    $tipo_evento      = $_POST["tipo_evento"];
    $desc_leg      = $_POST["desc_leg"];
    $simbolo_leg   = $_POST["simbolo_leg"];
    $sigla_leg   = $_POST["sigla_leg"];
    $cor_leg   = $_POST["cor_leg"];

    
    $sql = "update legenda set ";
    $sql .= "tipo_evento ='".$tipo_evento ."', desc_leg='".$desc_leg."', simbolo_leg='".$simbolo_leg."',";
    $sql .= "sigla_leg='".$sigla_leg."', cor_leg='".$cor_leg."'";
    $sql .= " where id_leg = '".$id_leg."';";

    $resultado = mysqli_query($con, $sql)or die(mysqli_error());

    if($resultado){
        header('Location: dash.php?page=lista_leg&msg=2');
        mysqli_close($con);
    }else{
        header('Location: dash.php?page=lista_leg&msg=4');
        mysqli_close($con);
    }
?>