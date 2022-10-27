<?php
$con = mysqli_connect('localhost', 'root', '', 'dailyevent');
$id_cal = mysqli_query($con, "select id_calendario as id from calendario  ORDER BY id_calendario ASC") or die(mysqli_error());
$id_tmp = mysqli_query($con, "select id_calendario as id from tmp_eve  ORDER BY id_calendario ASC") or die(mysqli_error());
while($cal = mysqli_fetch_array($id_cal) || $tmp = mysqli_fetch_array($id_tmp)){
    if(!empty($cal) && $cal != null){
        echo $cal['id'];
    }
    if(!empty($tmp) && $tmp != null){
        echo $tmp[0];
    }
}
?>