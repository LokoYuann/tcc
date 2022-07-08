<?php
    $mat_func      = $_POST["mat_func"];
    $usuario      = $_POST["usuario"];
    $senha   = $_POST["senha"];
    $nivel   = $_POST["nivel"];

    
    $sql = "update usuarios set ";
    $sql .= "mat_func ='".$mat_func ."', usuario='".$usuario."', senha='".$senha."',";
    $sql .= "nivel ='".$nivel ."'";
    $sql .= " where mat_func = '".$mat_func."';";

    $resultado = mysqli_query($con, $sql)or die(mysqli_error());

    if($resultado){
        header('Location: dash.php?page=lista_usu&msg=2');
        mysqli_close($con);
    }else{
        header('Location: dash.php?page=lista_usu&msg=4');
        mysqli_close($con);
    }
?>