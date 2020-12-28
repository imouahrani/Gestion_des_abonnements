<?php
session_start();
include '../../control/functions.php';
checkSessionValidity();
?>
<!doctype html>
<html>
<head>
<title>Enregistrer abonnement</title>
<meta charset="utf-8">
<link type="text/css" rel="stylesheet" href="../style/css/style.css"/>
</head>
<body>
<!--<p class="title">Enregistrer appareil</p>-->
<div  class="centred">
	
	<form action="../../control/traitement/?ttt=eA" method="post" target="appwin">
	    <fieldset style="width:50%;background-color:#e4fc72">
      <legend>Abonnement : </legend>
      <input class="input_form shadowed" type="text" name="type" placeholder="Type abonnement">
	  <fieldset style="width:50%;background-color:#e4fc72">
        <legend>Volume :</legend>
      <select class="input_form shadowed"  name="volume">
        <option>256/256</option>
		<option>128/512</option>
      </select>
	   </fieldset>
        <br>
		<textarea class="input_form shadowed" name="description" placeholder="Déscription abonnement"></textarea>
     
    </fieldset>
	<input class="input_form shadowed" type="submit" name="submit" value="Enregistrer abonnement">

	</form>
	<div id='right_aligned'>
	<?php
	
	?>
	</div>
	</div>
	

</body>
</html>