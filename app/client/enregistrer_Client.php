<?php
session_start();
include '../../control/functions.php';
checkSessionValidity();
  if(!($_SESSION['role']=="Simple")){
  	 header('Location:../../index.php');
  }
echo (isset($_POST['msg']))? "<script type='text/javascript'>alert('Effectué!')</script>":"";
?>

<!doctype html>
<html>
<head>
<title>Enregistrer client</title>
<meta charset="utf-8">
<link type="text/css" rel="stylesheet" href="../style/css/style.css"/>
<link type="text/css" rel="stylesheet" href="../../view/ressources/style/bootstrap/css/bootstrap.css"/>
<link type="text/css" rel="stylesheet" href="../../view/ressources/style/bootstrap/css/bootstrap-theme.css"/>

</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4">
    <p class="title">Espace Clients</p>
    <?php
	if(!isset($_GET['not_in'])){
	?>
		<legend>Rechercher Client :</legend>
        <input type="text" class="form-control input_form shadowed" name="s_box" onKeyUp="showHint(this.value)" placeholder="Nom du client">
        <p><span id="s_Field"></span></p>
		<?php
	}else{
	 ?>
        <span id="formError"></span>
        <form action="" id="formClient" method="post">
              <legend>Client : </legend>
              <input class="form-control input_form shadowed" type="text" id="nom_c" name="nom_c" placeholder="Nom">
              <br>
                <legend>Contacts : </legend>
                <input class="form-control input_form shadowed" type="text" id="tel_c" name="tel" placeholder="Numéro de téléphone">
                <br>
                <input class="form-control input_form shadowed" type="text" id="mail_c" name="mail" placeholder="Email">
				<br>
                <legend>Adresse :</legend>
                <input class="form-control input_form shadowed" type="text" id="prov_c" name="province" placeholder="Province">
                <br>
                <input class="form-control input_form shadowed" type="text" id="ville_c" name="ville" placeholder="Ville">
                <br>
                <input class="form-control input_form shadowed" type="text" id="aphy_c" name="ch_adresse" placeholder="Adresse physique">

              <legend>Abonnement : </legend>
              <select class="form-control input_form shadowed" name="volumeUD">
                <?php setDataList("volume","abonnement");?>
              </select>
              Up/Down

            <input class="form-control input_form shadowed" type="button" id="saveClient" name="submit" value="Enregistrer client">

        </form>

    </div>
    <div class="col-lg-7 col-md-7 col-sm-7 table-responsive" id="dataDisplay"></div>
  <?php
	actionClose("../../control/");
	}
	?>

  </div>
</div>
<script type="text/javascript" src="../../view/ressources/style/bootstrap/js/jquery.min.js"></script>
<script type="text/javascript" src="../../view/ressources/style/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="ajaxActions.js"></script>
</body>
</html>
