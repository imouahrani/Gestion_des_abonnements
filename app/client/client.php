<?php
/**
 * Created by PhpStorm.
 * User: Marcellin DBFX
 * Date: 19/10/2016
 * Time: 12:01
 */
session_start();
include '../../control/functions.php';
checkSessionValidity();
if(!($_SESSION['role']=="Simple")){
    header('Location:../../index.php');
}
echo '<meta charset="utf-8">';
echo '<link type="text/css" rel="stylesheet" href="../style/css/style.css"/>';
echo '<title>Facture</title>';
echo '<link type="text/css" rel="stylesheet" href="../../view/ressources/style/bootstrap/css/bootstrap.css"/>';
echo '<link type="text/css" rel="stylesheet" href="../../view/ressources/style/bootstrap/css/bootstrap-theme.css"/>';
//echo "yes";
//$id=14;
//var_dump($_GET);
if (isset($_GET['client_id'])){
    $id=$_GET['client_id'];
    $sQuery="SELECT client.nom AS nom_c, DATE_FORMAT(facturation.date, '%d/%m/%Y') AS date_f, abonnement.volume AS bp, ";
    $sQuery.="client.adresse AS adresse_c, DATE_FORMAT(DATE_ADD(facturation.date, INTERVAL 1 MONTH), '%d/%m/%Y') AS date_e_f,
          DATE_ADD(facturation.date, INTERVAL 1 MONTH) AS date_exp, client.id AS id, facturation.client_id AS fc_id ";
    $sQuery.="FROM client, facturation, abonnement ";
    $sQuery.="WHERE facturation.client_id=client.id ";
    $sQuery.="AND facturation.abonnement_id=abonnement.id ";
    $sQuery.="AND client.id=".$id;
    $sQuery.=" ORDER BY facturation.date DESC ";
    $sQuery.=" LIMIT 0, 1";

    $fieldArray=array("nom_c", "bp", "date_e_f");
    $fieldNameArray=array("Client");
    echo "<legend>Client</legend>";
    displaySingleData($sQuery,$fieldArray,"nom_c");
}


