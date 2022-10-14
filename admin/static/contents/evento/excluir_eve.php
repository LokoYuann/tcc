<?php
$id_evento = (int) @$_GET['id_evento'];
$cal_sql = mysqli_query($con, "select id_calendario from eventos where id_evento = '".$id_evento."'");
$cal = mysqli_fetch_array($cal_sql);
$sql = "insert into tmp_eve values ";
    $sql .= "('','','$cal[0]','','del','$id_evento');";

$resultado = mysqli_query($con, $sql)or die(mysqli_error());

if ($resultado) {
    header('Location: ?page=lista_eve&msg=3');
    mysqli_close($con);
}else{
    header('Location: ?page=lista_eve&msg=4');
    mysqli_close($con);
}
?>
