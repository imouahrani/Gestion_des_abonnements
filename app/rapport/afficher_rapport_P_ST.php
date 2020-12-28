<?php
session_start();
include '../../control/functions.php';
checkSessionValidity();


echo '<meta charset="utf-8">';
echo '<link type="text/css" rel="stylesheet" href="../style/css/style.css"/>';

$q="";

echo '<p><a href="afficher_rapport_P_ST.php?q=cp">Charge - phone</a></p>';
echo '<p><a href="afficher_rapport_P_ST.php?q=se">Salle de travail</a></p>';

include('../../control/functions.php');

$hebdo=7;

$date_one_week_before=mktime(0, 0, 0, date("m")  , date("d")-7, date("Y"));
$date_one_week_before=date("d-m-Y",$date_one_week_before);
$date_today=date('d-m-Y');

echo "<h1>Rapport Hebdomadaire du ".$date_one_week_before." au ".$date_today."<h1>";

if(isset($_GET['q'])){
$q=$_GET['q'];

if($q=="cp"){

$fieldArray=array("Proprietaire", "Numero du jeton", "Cout[CDF]");
$fieldNameArray=array("proprietaire" ,"num_jeton" ,"cout");
generateRapport("phone", "heure_Entree", 1, $fieldNameArray, $fieldArray, $hebdo);
//echo date("H:i");
echo '<br><marquee behavior="alternate" direction="right">*um =>[CDF] : Francs Congolais</marquee>';

}else{
$fieldArray=array("Abonné","Cout[CDF]", "Heure d'arrivéé");
$fieldNameArray=array("nom_beneficiaire" ,"cout" ,  "heure_Arrivee");
generateRapport("s_energie", "heure_Arrivee", 1, $fieldNameArray, $fieldArray, $hebdo);

echo '<br><marquee behavior="alternate" direction="right">*um =>[CDF] : Francs Congolais</marquee>';
}
?>
<br/><br/>
<input type="submit" id="pr_btn" class="input_form" onclick="printReport()" value="Imprimer rapport"> 
<script src="../style/jquery/jquery.js"></script>
<script>
function printReport(){
	$(function(){	
	$('#pr_btn').css('display','none');		
	});
	window.print();
	}
</script>
<?php
}
?>
