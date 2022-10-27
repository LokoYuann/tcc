<?php
$con = mysqli_connect('localhost', 'root', '', 'dailyevent');
$daysql = mysqli_query($con, "select id_leg, EXTRACT(DAY FROM dt_ini_ev) AS d_ini, EXTRACT(DAY FROM dt_fim_ev) AS d_fim, EXTRACT(MONTH FROM dt_ini_ev) AS m_ini, EXTRACT(MONTH FROM dt_fim_ev) AS m_fim, id_evento, dt_ini_ev as data_ini, dt_fim_ev as data_fim from eventos where id_calendario = '2' order by dt_ini_ev ;");
$meses = array("","Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");

$calendario_lis = "<table class='table table-bordered table-responsive border border-4 stripped' id='list_cal' >";
$calendario_lis .= "<tr>";
$calendario_lis .= "<td>Mês</td>";
$calendario_lis .= "<td colspan='2'>Data de início</td>";
$calendario_lis .= "<td colspan='2'>Data de fim</td>";
$calendario_lis .= "<td>Legenda</td>";
$calendario_lis .= "</tr>";
while($row = mysqli_fetch_array($daysql)){
    $dias = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];
    $week_ini = date("w", strtotime($row['data_ini']));
    $week_fim = date("w", strtotime($row['data_fim']));

    $leg_sql = mysqli_query($con, "select * from legenda where id_leg = '".$row['id_leg']."'");
    $leg = mysqli_fetch_array($leg_sql);

    $calendario_lis .= "<tr>";
    $calendario_lis .= "<td>".$meses[$row['m_ini']]."</td>";
    $calendario_lis .= "<td>".$row['d_ini']."/".$row['m_ini']."</td>";
    $calendario_lis .= "<td>".$dias[$week_ini]."</td>";
    $calendario_lis .= "<td>".$row['d_fim']."/".$row['m_fim']."</td>";
    $calendario_lis .= "<td>".$dias[$week_fim]."</td>";
    $calendario_lis .= "<td>".$leg['desc_leg']."</td>";

    $calendario_lis .= "</tr>";
}
$calendario_lis .= "</table>";
?>