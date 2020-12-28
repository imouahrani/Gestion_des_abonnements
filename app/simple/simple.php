<?php
session_start();
include '../../control/functions.php';
checkSessionValidity();
  if(!($_SESSION['role']=="Simple")){
  	 header('Location:../../index.php');
  }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta   charset="utf-8"/>
<link type="text/css" rel="stylesheet" href="../../view/ressources/style/css/style.css"/>
<link type="text/css" rel="stylesheet" href="../../view/ressources/style/bootstrap/css/bootstrap.css"/>
<link type="text/css" rel="stylesheet" href="../../../vue/ressources/style/bootstrap/css/bootstrap-theme.css"/>
<title>Tableau de bord</title>
</head>
<body OnLoad="namosw_init_clock('type6', 6)">
<div class="container">
  <?php getHeader("../../view/ressources/images/","../../control/"); ?>
  <div id="global" class="col-lg-6 col-lg-offset-3 col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6 centred encapsuled">
    <div class="menu col-lg-12 col-md-12 col-sm-12"> </div>
    <div class="row">

      <div id="first" class="box col-lg-5 col-lg-offset-1 col-md-offset-1 col-md-5 col-sm-offset-1 col-sm-5">
        <?php if($_SESSION['role']=="Simple"){?>
        <legend>Espace Client</legend>
        <a href="../client/enregistrer_Client.php?not_in">Nouveau</a><br>
        <a href="../client/enregistrer_Client.php">Rechercher</a>
        <?php }else{?>

        <?php
		}
		?>
      </div>

      <div id="sec" class="box col-lg-5 col col-md-5 col-sm-5">
        <?php if($_SESSION['role']=="Simple"){?>
        <legend>Notifications</legend>
        <a href="#">Notification</a>
        <?php }else{?>


        <?php
		}
		?>
      </div>
    </div>

    <div class="row">

      <div id="third" class="box col-lg-5 col-md-offset-1 col-md-5 col-sm-offset-1 col-sm-5">
        <legend>Rapport</legend>
        <a href="#">Rapports</a><br>
        <a href="#">Rechercher Rapport</a><br>
      </div>

      <div id="fourth" class="box col-lg-5 col-md-5 col-sm-5">
      <legend>Factures</legend>
      <a href="#">Nouvelle</a><br>
      <a href="#">Rechercher</a>
      </div>

    </div>

    <div class="row">
      <div id="footer" class="col-lg-12 col-md-12 col-sm-12 centred encapsuled">
     <?php echo "Utilisateur connecté : <strong class='blue_claire'>".$_SESSION['username']."</strong><br>"; ?>
     &copy; Atom System <?php echo date('Y')?>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="../../view/ressources/style/bootstrap/js/jquery.min.js"></script>
<script type="text/javascript" src="../../view/vue/ressources/style/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="style/javascript/displayClock.js"></script>
</body>
</html>
