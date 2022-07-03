<?php
$id_evento = (int) @$_GET['id_evento'];
 
$sql = "delete from eventos where id_evento = '$id_evento';"; 

$resultado = mysqli_query($con, $sql)or die(mysqli_error());

if ($resultado) {
    header('Location: ?page=lista_eve&msg=3');
    mysqli_close($con);
}else{
    header('Location: ?page=lista_eve&msg=4');
    mysqli_close($con);
}
?>
