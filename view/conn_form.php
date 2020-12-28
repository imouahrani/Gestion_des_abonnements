<?php
session_start();
session_destroy();
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Connexion</title>
<meta content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="ressources/style/css/style.css" type="text/css">
<link type="text/css" rel="stylesheet" href="ressources/style/bootstrap/css/bootstrap.css"/>
<link type="text/css" rel="stylesheet" href="ressources/style/bootstrap/css/bootstrap-theme.css"/>

</head>

<body>
	
	<div id="sidebar" class="centred">
	<h1>ATS CM</h1>
	
	<img id="logo" class="centred shadowed opaque" src="ressources/images/logo.jpg" alt="Logo"/>
	<form action="../control/authent.php" method="post">
    <br>
	<h4>Entrez vos identifiants pour acceder au système</h4>
	<input class="form-control shadowed" type="text" name="user" placeholder="Nom d'utilisateur"><br>
	<input class="form-control shadowed" type="password" name="pass" placeholder="Mot de passe"><br>
    <input id="sub" type="submit" class="form-control shadowed btn btn-primary" name="submit" value="Connexion">
	</form>	
	</div>

<script type="text/javascript" src="ressources/style/bootstrap/js/jquery.min.js"></script> 
<script type="text/javascript" src="ressources/style/bootstrap/js/bootstrap.min.js"></script>    
</body>
</html>