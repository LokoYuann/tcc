<?php
$mat_func = (int) @$_GET['mat_func'];
 
$sql = "delete from usuarios where mat_func = '$mat_func';"; 

$resultado = mysqli_query($con, $sql)or die(mysqli_error());

if ($resultado) {
    header('Location: ?page=lista_usu&msg=3');
    mysqli_close($con);
}else{
    header('Location: ?page=lista_usu&msg=4');
    mysqli_close($con);
}
?>
