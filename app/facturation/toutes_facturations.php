<?php
session_start();
include('../../control/functions.php');
checkSessionValidity();


echo '<meta charset="utf-8">';
echo '<link type="text/css" rel="stylesheet" href="../style/css/style.css"/>';
echo '<link type="text/css" rel="stylesheet" href="../../view/ressources/style/bootstrap/css/bootstrap.css"/>';
echo '<link type="text/css" rel="stylesheet" href="../../view/ressources/style/bootstrap/css/bootstrap-theme.css"/>';

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
          DATE_ADD(facturation.date, INTERVAL 1 MONTH) AS date_exp, client.id AS id ";
$sQuery.="FROM client, facturation, abonnement ";
$sQuery.="WHERE facturation.client_id=client.id ";
$sQuery.="AND facturation.abonnement_id=abonnement.id ";
$sQuery.="ORDER BY facturation.date DESC ";
$sQuery.="LIMIT ".$firstItem.", ".$itemByPage;

$fieldArray=array("nom_c", "bp", "date_e_f");
$fieldNameArray=array("Clients","Abonnement","Prochaine facturation");

echo "<legend>Abonnenments enregistrés(".$allItems.")</legend>";
displayData($sQuery,$fieldArray,$fieldNameArray,"nom_c");

//***********************************************************************************************************************

//******************************

echo '<p align="center" id="pageNumDisplay">Page : '; //Pour l'affichage, on centre la liste des pages
for($i=1; $i<=$numberOfPages; $i++) //On fait notre boucle
{
     //On va faire notre condition
     if($i==$currentPage) //Si il s'agit de la page actuelle...
     {
         echo ' [ '.$i.' ] ';
     }
     else //Sinon...
     {
          echo ' <a href="toutes_facturations.php?page='.$i.'">'.$i.'</a> ';
     }
}
echo '</p>';

//*******************************

/*$dbCon=connectDb();

$pQuery=$dbCon->prepare($sQuery);
$pQuery->execute();

echo '<table>';
echo '<tr><th>Client</th><th>Abonnement</th><th>Prochaine facturation</th></tr>';
while ($data=$pQuery->fetch()) {
    $date_e_f=$data['date_exp'];
    echo "<tr><td><a href='#'>".$data['nom_c']."</a><br>".getAdressDetails($data['adresse_c']).
         "</td><td>".getAbonnementBp($data['bp'])."(".$data['bp'].")"."<!--<br>".$data['date_f'].
         "--></td><td>".$data['date_e_f']." (".notifyExpiryDate($date_e_f).")"."</td></tr>";
}
echo '</table>';*/
