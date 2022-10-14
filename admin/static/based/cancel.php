<?php
$con = mysqli_connect('localhost', 'root', '', 'dailyevent');
$sql = "delete from tmp_eve where id_calendario = '".$_GET['cal']."';"; 

$resultado = mysqli_query($con, $sql)or die(mysqli_error());

// if ($resultado) {
//     header('Location: ?page=home');
//     mysqli_close($con);
// }else{
//     header('Location: ?page=home');
//     mysqli_close($con);
// }
?>