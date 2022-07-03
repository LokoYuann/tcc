<?php
    $id_ue		  = $_POST["id_ue"];
    $tel_ue      = $_POST["tel_ue"];
    $nome_ue      = $_POST["nome_ue"];
    $sigla_ue   = $_POST["sigla_ue"];
    $email_ue   = $_POST["email_ue"];
    $logo_ue   = $_POST["logo_ue"];
    $cep   = $_POST["cep"];

    
    $sql = "update ue set ";
    $sql .= "id_ue ='".$id_ue ."', tel_ue='".$tel_ue."', nome_ue='".$nome_ue."',";
    $sql .= "sigla_ue='".$sigla_ue."', email_ue='".$email_ue."', logo_ue='".$logo_ue."',";
    $sql .= "cep ='".$cep ."'";
    $sql .= " where id_ue = '".$id_ue."';";

    $resultado = mysqli_query($con, $sql)or die(mysqli_error());

    if($resultado){
        header('Location: dash.php?page=lista_leg&msg=2');
        mysqli_close($con);
    }else{
        header('Location: dash.php?page=lista_leg&msg=4');
        mysqli_close($con);
    }
?>