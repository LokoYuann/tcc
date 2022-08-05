<?php


$mat_func      = $_POST["mat_func"];
$funcao_func   = $_POST["funcao_func"];
$nome_func     = $_POST["nome_func"];
$nasc_func     = $_POST["nasc_func"];
$sexo_func     = $_POST["sexo_func"];
$tel_func      = $_POST["tel_func"];
$cpf_func      = $_POST["cpf_func"];
$cep      = $_POST["cep"];
$id_ue         = $_POST["id_ue"];

    
    $sql = "update funcionario set ";
    $sql .= "mat_func ='".$mat_func ."', funcao_func='".$funcao_func."', nome_func='".$nome_func."', nasc_func='".$nasc_func."', sexo_func='".$sexo_func."',";
    $sql .= "tel_func='".$tel_func."', cpf_func='".$cpf_func."', cep='".$cep."', id_ue='".$id_ue."'";
    $sql .= " where mat_func = '".$mat_func."';";

    $resultado = mysqli_query($con, $sql)or die(mysqli_error());

    if($resultado){
        header('Location: dash.php?page=lista_func&msg=2');
        mysqli_close($con);
    }else{
        header('Location: dash.php?page=lista_func&msg=4');
        mysqli_close($con);
    }
?>