<?php
$con = mysqli_connect('localhost', 'root', '', 'dailyevent');

$daytmp_sql = mysqli_query($con, "select id_leg, EXTRACT(DAY FROM dt_ini_tmp) AS d_ini, EXTRACT(DAY FROM dt_fim_tmp) AS d_fim, EXTRACT(MONTH FROM dt_ini_tmp) AS m_ini, EXTRACT(MONTH FROM dt_fim_tmp) AS m_fim from tmp_eve where id_calendario = '1' order by dt_ini_tmp ;");

if($daytmp_sql === 1){
    echo "null";
}
else{echo "not null";}
?>