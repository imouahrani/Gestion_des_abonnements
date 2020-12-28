<?php
session_start();
include '../../control/functions.php';
checkSessionValidity();

echo '<meta charset="utf-8">';
echo '<link type="text/css" rel="stylesheet" href="../style/css/style.css"/>';

include('../../control/functions.php');

if(isset($_GET['msg'])){
$err_msg=$_GET['msg'];
$msg='<script type="text/javascript">';
$msg.='alert('.$err_msg;
$msg.=')</script>';

echo $msg;

}

$fieldNameArray=array("Designation","Marque","Proprietaire","Date de dépôt");
$fieldArray=array("designation","marque","nom_proprietaire","date_depot");

displayData("appareil",$fieldArray,$fieldNameArray,"designation");
