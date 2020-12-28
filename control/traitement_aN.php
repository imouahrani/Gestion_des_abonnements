<?php
echo '<meta charset="utf-8">';
$date_yesterday="";
$date_today="";
//DATE_FORMAT(date, '%Hh%imin%ss') as heure_formatee
$sQuery="SELECT *, DATE_FORMAT(date_d_notification, '%Hh%imin%ss') as heure_formatee";
$sQuery.=" FROM notifications";
$sQuery.=" WHERE date_d_notification <= NOW()";
$sQuery.=" AND date_d_notification >= DATE_SUB(NOW(), INTERVAL 2 DAY)";

include('../model/connexion.php');

$result = $databaseConnection->prepare($sQuery);
/*
$date_yesterday=mktime(0, 0, 0, date("m")  , date("d")-2, date("Y"));
$date_yesterday=date("Y-m-d H-i-s",$date_yesterday);
$date_today=date('Y-m-d H-i-s');
*/
$result->execute(array(
$date_today,
$date_yesterday
));

while($data=$result->fetch()){

echo '<span>';
echo $data['heure_formatee'].' : ';
echo '<a href="../../view/details.php?q_table='.$data['table_ev_insert'].'&q_id='.$data['id_ev_ob'].'">';
echo $data['evenement'].'</a><br/>';
echo '</span>';

}
echo '<marquee behavior="alternate"><h4> Date ->'.date('d-m-Y').'</h4></marquee>';
//echo $date_yesterday;