<?php
session_start();
include('../../control/functions.php');
checkSessionValidity();
 ?>
<!doctype html>
<html>
<head>
<title>Ajouter membre</title>
<meta charset="utf-8">
<link type="text/css" rel="stylesheet" href="../style/css/style.css"/>
</head>
<body>
<p class="title">Ajouter utilisateur</p>
<div  class="centred">

	<form action="../../control/traitement/?ttt=aU" method="post">
	<fieldset style="width:50%;background-color:#e4fc72">
    <legend>Utilisateur : </legend>

      <input class="input_form shadowed" type="text" name="nom_u" placeholder="Nom">
      <fieldset style="width:50%;background-color:#e4fc72">
      <legend>Rôle système : </legend>
      <select class="input_form shadowed" name="role">
        <option>Admin</option>
		<option>Simple</option>
      </select>
    </fieldset>
	  <input class="input_form shadowed" type="text" name="user_u" placeholder="Nom utilisateur">
	  <br>
      <input class="input_form shadowed" type="text" name="pass_u" placeholder="Mot de passe">

    </fieldset>
	<input class="input_form shadowed" type="submit" name="submit" value="Enregistrer utilisateur">
	</form>
	<div id='right_aligned'>
	<?php
	//Récuperation des 20 dernieres fournitures
	include('fournitures.php');
	?>
	</div>
	</div>


</body>
</html>
