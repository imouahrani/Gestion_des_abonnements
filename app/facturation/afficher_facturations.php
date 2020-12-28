<?php
session_start();
include('../../control/functions.php');
checkSessionValidity();


echo '<meta charset="utf-8">';
echo '<link type="text/css" rel="stylesheet" href="../style/css/style.css"/>';

//Getting here the number of entries in our database table
$countFacturations="SELECT * FROM facturation";
$dbCon=connectDb();
$pQuery=$dbCon->prepare($countFacturations);
$pQuery->execute();
//Here it is
$rowCount=$pQuery->rowCount();
$pQuery->closeCursor();

//***********************************************************************************************************************
//Inspired from an article on developpez.com
$itemByPage=5;
$allItems=$rowCount;
$numberOfPages=ceil($allItems/$itemByPage);

if(isset($_GET['page'])){
     $currentPage=intval($_GET['page']);
     if($currentPage>$numberOfPages){
          $currentPage=$numberOfPages;
     }
}else{
     $currentPage=1;
}

$firstItem=($currentPage-1)*$itemByPage;
//***********************************************************************************************************************
$sQuery="SELECT client.nom AS nom_c, DATE_FORMAT(facturation.date, '%d/%m/%Y') AS date_f, abonnement.volume AS bp, ";
$sQuery.="client.adresse AS adresse_c, DATE_FORMAT(DATE_ADD(facturation.date, INTERVAL 1 MONTH), '%d/%m/%Y') AS date_e_f,
          DATE_ADD(facturation.date, INTERVAL 1 MONTH) AS date_exp, client.id AS id, facturation.client_id AS fc_id ";
$sQuery.="FROM client, facturation, abonnement ";
$sQuery.="WHERE facturation.client_id=client.id ";
$sQuery.="AND facturation.abonnement_id=abonnement.id ";
$sQuery.="AND (DATE_ADD(facturation.date, INTERVAL 1 MONTH)-NOW())<=30 ";
$sQuery.="ORDER BY facturation.date DESC ";
$sQuery.="LIMIT ".$firstItem.", ".$itemByPage;

$fieldArray=array("nom_c", "bp", "date_e_f");
$fieldNameArray=array("Clients","Abonnement","Prochaine facturation");

echo "<legend>Clients récents</legend>";
displayData($sQuery,$fieldArray,$fieldNameArray,"nom_c");

echo "<a href='../facturation/toutes_facturations.php'>Plus...</a>";
//***********************************************************************************************************************
