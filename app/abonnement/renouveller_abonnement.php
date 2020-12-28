<?php
session_start();
include '../../control/functions.php';
checkSessionValidity();
  if(!($_SESSION['role']=="Simple")){
  	 header('Location:../../index.php');
  }
//echo $_GET['cl_id'];
//var_dump($_GET);
echo "<br>";
isset($_GET['cl_id'])? $cl_id=$_GET['cl_id']:"";
?>

<!doctype html>
<html>
<head>
<title>Renouveller abonnement</title>
<meta charset="utf-8">
<link type="text/css" rel="stylesheet" href="../style/css/style.css"/>
<link type="text/css" rel="stylesheet" href="../../view/ressources/style/bootstrap/css/bootstrap.css"/>
<link type="text/css" rel="stylesheet" href="../../view/ressources/style/bootstrap/css/bootstrap-theme.css"/>
</head>
<body>
<div class="container">
  <div class="row">
      <span id="formError"></span>
      <form action="traitement_ra.php" id="formRA" method="post">
          <legend>Client : </legend>
          <input class="form-control input_form shadowed" type="text" id="nom_c" name="nom_c"
                 value="<?php echo getFieldFromAnyElse('client','id',$cl_id,'nom');?>" readonly>
          <br>
          <legend>Abonnement : </legend>
          <select class="form-control input_form shadowed" name="volumeUD">
              <?php setDataList("volume","abonnement");?>
          </select>
          Up/Down
          <input class="form-control input_form shadowed" type="submit" id="renAb" value="Renouveller abonnement">
      </form>

  </div>
</div>
<script type="text/javascript" src="../../view/ressources/style/bootstrap/js/jquery.min.js"></script> 
<script type="text/javascript" src="../../view/ressources/style/bootstrap/js/bootstrap.min.js"></script> 
<script type="text/javascript" src=""></script>
</body>
</html>
