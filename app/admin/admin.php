<?php
session_start();
include '../../control/functions.php';
checkSessionValidity();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta   charset="utf-8"/>
<link type="text/css" rel="stylesheet" href="../style/css/style.css"/>

<title>Tableau de bord</title>
</head>
<body OnLoad="namosw_init_clock('type6', 6)">
<div id="header">
	
	<h2>Bienvenu<?php echo ' '.$_SESSION['username'].' <h4>('.$_SESSION['role'].')</h4>';?></h2>
	
	
</div>

<div id="global" class="centred encapsuled">

	<div id="menuBox" class="menu">
    
	
	</div>
	<div id="first" class="box opaque"> 
	<a href="../utilisateur/ajouter_utilisateur.htm">Ajouter utilisateur</a>
	</div>
	<div id="sec" class="box opaque"> 
	<a href="../notification/afficher_notifications.php">Notifications</a>
	</div>
	<div id="third" class="box opaque"></div>
	<div id="fourth" class="box opaque">
		
		<?php
		if($_SESSION['role']=="su"){		
		?>
		<a href="su/config.php">Paramètres</a>
		<?php
		}
		?>
		
	</div>

</div>

<div id="footer" class="centred encapsuled">
	<div id="sec_menu" class="menu">
	<a id="logout" href="../../control/logout.php" target="_self">Déconnexion</a>
	</div>
</div>

<script type="text/javascript" src="style/javascript/displayClock.js"></script>
</body>
</html>