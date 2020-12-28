<?php
session_start();
include '../../control/functions.php';
checkSessionValidity();

echo '<meta charset="utf-8">';
echo '<link type="text/css" rel="stylesheet" href="../style/css/style.css"/>';

include('../../control/functions.php');

$hebdo=7;


$date_one_week_before=mktime(0, 0, 0, date("m")  , date("d")-7, date("Y"));
$date_one_week_before=date("d-m-Y",$date_one_week_before);
$date_today=date('d-m-Y');

echo "<h1>Rapport Hebdomadaire du ".$date_one_week_before." au ".$date_today."<h1>";
$fieldArray=array("Appareil", "Marque de l'appareil","Réparateur", "Cout[$ USD]","Etat de l'appateil", "date de réparation");
$fieldNameArray=array( "appareil" , "marque" , "reparateur" , "cout" , "etat_appareil" , "date_reparation");
generateRapport("appareil, reparations", "date_reparation", "appareil.id=reparations.id_appareil", $fieldNameArray, $fieldArray, $hebdo);

echo '<br><marquee behavior="alternate" direction="right">*um =>[USD, $] :Dollars Américains</marquee><br><br>';
echo '<input type="submit" id="pr_btn" class="input_form" onclick="printReport()" value="Imprimer rapport">';
?>
<script src="../style/jquery/jquery.js"></script>
<script>
function printReport(){
	$(function(){	
	$('#pr_btn').css('display','none');		
	});
	window.print();
	}
</script>