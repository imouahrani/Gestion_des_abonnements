<?php
session_start();

?>
<!DOCTYPE HTML>
<html>
<head>
<title>Sommaire</title>
<meta content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="../app/style/css/style.css" type="text/css">

</head>

<body OnLoad="namosw_init_clock('type6', 6)">
	
	<div id="sidebar" class="centred">
			<img class="centred form-control shadowed opaque" src="ressources/images/logo.jpg" height="150px" width="150px" alt="Logo" />
			<br/>
			<br/>
			<form action="index.php" target="appwin">
			<input type="image" class="form-control shadowed" src="ressources/images/ico_accueil.png" name="Submit" value="Envoyer" height="45px" width="150px">
			</form>
    	<form action="about.php" target="appwin">
		<input type="image" class="form-control shadowed" src="ressources/images/ico_about.png" name="Submit" value="Envoyer" height="45px" width="150px">
		</form>
		<br/>
		<br/>
		<br/>
	</div>
	<div id="display_time">
	<ul type="none">
		<li id="type6"></li>
	</ul>
	</div>
<script type="text/javascript" src="ressources/style/javascript/displayClock.js"></script>
</body>
</html>