<?php
session_start();
include '../../control/functions.php';
checkSessionValidity();
?>

<!doctype html>
<html>
<head>
<title>Enregistrer client</title>
<meta charset="utf-8">
<link type="text/css" rel="stylesheet" href="../style/css/style.css"/>
<script type="text/javascript" src="../jquery/jquery.min.js"></script>
<script type="text/javascript" src="ajaxActions.js"></script>
<script type="text/javascript">
</script>
</head>
<body>
<div id="mainFrame">
<p class="title">Espace Clients</p>
<p id="formError"></p>


	<form action="" id="formClient" method="post">

	<div  id="save_cliData_box">
	<fieldset style="width:33%;background-color:#e4fc72">
    <legend>Client : </legend>
      <input class="input_form shadowed" type="text" id="nom_c" name="nom_c" placeholder="Nom">
      <fieldset style="width:90%">
        <legend>Contacts : </legend>
        <input class="input_form shadowed" type="text" id="tel_c" name="tel" placeholder="Numéro de téléphone">
        <br>
        <input class="input_form shadowed" type="text" id="mail_c" name="mail" placeholder="Email">
      </fieldset>
      <fieldset style="width:90%">
        <legend>Adresse :</legend>
        <input class="input_form shadowed" type="text" id="prov_c" name="province" placeholder="Province">
        <br>
        <input class="input_form shadowed" type="text" id="ville_c" name="ville" placeholder="Ville">
        <br>
        <input class="input_form shadowed" type="text" id="aphy_c" name="ch_adresse" placeholder="Adresse physique">
      </fieldset>

    </fieldset>
    <fieldset style="width:33%;background-color:#e4fc72">
      <legend>Abonnement : </legend>
      <select class="input_form shadowed" name="volumeUD">
        <?php
        setDataList("volume","abonnement");
        ?>
      </select>Up/Down
    </fieldset>
	<input class="input_form shadowed" type="button" id="saveClient" name="submit" value="Enregistrer client">
	</div>
	</form>
	<div id="search_cli_box">
	<fieldset style="width:33%; background-color:#e4fc72;">
	<legend>Rechercher Client :</legend>
	<input type="text" class="input_form shadowed" name="s_box" onKeyUp="showHint(this.value)" placeholder="Nom du client">
	<p><span id="s_Field"></span></p>
	</fieldset>
	</div>

</div>
<div class="right_aligned" id="dataDisplay">
	<div class="loading-overlay"><div class="overlay-content">Loading.....</div></div>
    <div id="posts_content">
    <?php
    //Include pagination class file
    include('../pagination/Pagination.php');
    
    $limit = 5;
    
	//Getting here the number of entries in our database table
	$countFacturations="SELECT * FROM facturation";
	$dbCon=connectDb();
	$pQuery=$dbCon->prepare($countFacturations);
	$pQuery->execute();
	//Here it is
	$rowCount=$pQuery->rowCount();
	$pQuery->closeCursor();
    
    //initialize pagination class
    $pagConfig = array('baseURL'=>'afficher_facturation.php', 'totalRows'=>$rowCount, 'perPage'=>$limit, 'contentDiv'=>'posts_content');
    $pagination =  new Pagination($pagConfig);
    
    //get rows
	$sQuery="SELECT client.nom AS nom_c, DATE_FORMAT(facturation.date, '%d/%m/%Y') AS date_f, abonnement.volume AS bp, ";
	$sQuery.="client.adresse AS adresse_c, DATE_FORMAT(DATE_ADD(facturation.date, INTERVAL 1 MONTH), '%d/%m/%Y') AS date_e_f,
			  DATE_ADD(facturation.date, INTERVAL 1 MONTH) AS date_exp, client.id AS id ";
	$sQuery.="FROM client, facturation, abonnement ";
	$sQuery.="WHERE facturation.client_id=client.id ";
	$sQuery.="AND facturation.abonnement_id=abonnement.id ";
	$sQuery.="ORDER BY facturation.date DESC ";
	$sQuery.="LIMIT ".$limit;
	
	$fieldArray=array("nom_c", "bp", "date_e_f");
	$fieldNameArray=array("Clients","Abonnement","Prochaine facturation");
	
	displayData($sQuery,$fieldArray,$fieldNameArray,"nom_c");
    $pQuery=$dbCon->query($sQuery);
    if($pQuery->num_rows > 0){ ?>
        <div class="posts_list">
        <?php
            while($row = $pQuery->fetch_assoc()){ 
                $postID = $row['id'];
        ?>
            <div class="list_item"><a href="javascript:void(0);"><h2><?php echo $row["title"]; ?></h2></a></div>
        <?php } ?>
        </div>
        <?php echo $pagination->createLinks(); ?>
    <?php } ?>
    </div>
</div>
</body>
</html>
