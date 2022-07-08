<?php

    $tel_ue      = $_POST["tel_ue"];
    $nome_ue      = $_POST["nome_ue"];
    $sigla_ue   = $_POST["sigla_ue"];
    $email_ue   = $_POST["email_ue"];
    $logo_ue   = $_POST["logo_ue"];
    $cep   = $_POST["cep"];

   $sql = "insert into legenda values ";
    $sql .= "('0','$tel_ue','$nome_ue','$sigla_ue','$email_ue','$logo_ue','$cep');";
    
    
    $resultado = mysqli_query($con, $sql)or die(mysqli_error());

    if($resultado){
        header('Location: dash.php?page=lista_usu&msg=1');
        mysqli_close($con);
    }else{
        header('Location: dash.php?page=lista_usu&msg=4');
        mysqli_close($con);
    }
?>