<?php
#Connecion to DB

function connectDb(){

  $host="localhost";
  $db="ats_07m16_db";
  $url="mysql:host=".$host;
  $url.=";dbname=".$db;

  $user="root";
  $pass="";
  //Connexion PDO à la BD
  try {
    $databaseConnection = new PDO($url, $user, $pass);
    $databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    echo 'ERREUR: ' . $e->getMessage();
  }
  return $databaseConnection;
}

//Recuperation des données transmises
function getField($fieldValue){
	if (isset($fieldValue) && $fieldValue !='') $fieldValue=htmlspecialchars(trim($fieldValue));
	else{
	echo "<p class='alert labelInfo-danger col-lg-offset-3'>Completer les champs vides!</p>";
	exit;
	}
	return $fieldValue;
}

//Recuperer données pour listes deroulante
function setDataList($field,$table){

$sQuery="SELECT ".$field;
$sQuery.=" FROM ".$table;
$sQuery.=" ORDER BY id DESC";

$dbCon=connectDb();

$result=$dbCon->query($sQuery);

while($data=$result->fetch()){
					echo '<option>'.$data[$field].'</option>';
				}

}

//Insertion dans la BD

function insertUtilisateur($User){
$iQuery="INSERT
		 INTO utilisateurs (nom, role, username, password)
		 VALUES(:nom, :role, :username, :password);
		";
$dbCon=connectDb();
$req=$dbCon->prepare($iQuery);
$req->execute(array(
	'nom'=>$User->getNom(),
	'role'=>$User->getRole(),
	'username'=>$User->getUsername(),
	'password'=>$User->getPassword()
));
echo "<script type='text/javascript'>alert('Succes')</script>";
}
//------------------------------------------------------------------------------

function insertClient($Client){
$iQuery="INSERT
		 INTO client (nom, adresse, contact)
		 VALUES(:nom, :adresse, :contact);
		";
$dbCon=connectDb();
$req=$dbCon->prepare($iQuery);
$req->execute(array(
	'nom'=>$Client->getNom(),
	'adresse'=>$Client->getAdresse(),
	'contact'=>$Client->getContacts()
	));
$req->closeCursor();

}

function getClientId($nom, $adresse, $contact){

$sQuery="SELECT * ";
$sQuery.="FROM client ";
$sQuery.="WHERE nom = ? AND adresse = ? AND contact= ?";
$dbCon=connectDb();
$req=$dbCon->prepare($sQuery);
$req->execute(array(
	$nom, $adresse, $contact
));

$client_id=0;
while($resultSet=$req->fetch()){
	$client_id=$resultSet['id'];
}
$req->closeCursor();

return $client_id;
}
//------------------------------------------------------------------------------


function insertAbonnement($Abonnement){
$iQuery="INSERT
		 INTO abonnement (type, volume, description)
		 VALUES(:type, :volume, :description);
		";
$dbCon=connectDb();
$req=$dbCon->prepare($iQuery);
$req->execute(array(
	'type'=>$Abonnement->getType(),
	'volume'=>$Abonnement->getVolume(),
	'description'=>$Abonnement->getDescription()
	));
echo "<script type='text/javascript'>alert('Succes')</script>";
//header('Location:../app/client/enregistrer_client.php?msg=Effectué!');
}
//------------------------------------------------------------------------------

function insertFacturation($c, $a){

$iQuery="INSERT
		 INTO facturation (date, client_id, abonnement_id)
		 VALUES(NOW(), :client_id, :abonnement_id);
		";
$dbCon=connectDb();
$req=$dbCon->prepare($iQuery);
$req->execute(array(
	'client_id'=>$c,
	'abonnement_id'=>$a
	));
$req->closeCursor();

}
//------------------------------------------------------------------------------

//Authentifier membre
function validerMembre($user, $pass){
$errMsg = '';
if(isset($user) && isset($pass)){

	$user = trim($user);
	$pass = trim($pass);

		if($user == '')
			$errMsg .= 'Vous devez avoir un login<br>';

		if($pass == '')
			$errMsg .= 'Vous devez avoir un mot de passe<br>';


		if($errMsg == ''){
			$dbCon=connectDb();
			$sQuery="SELECT nom,role,username,password ";
			$sQuery.="FROM utilisateurs ";
			$sQuery.="WHERE username=:username";

			$records = $dbCon->prepare($sQuery);
			$records->bindParam(':username', $user);
			$records->execute();
			$results = $records->fetch(PDO::FETCH_ASSOC);
			if(count($results) > 0 && cryptPw($pass)==$results['password']){
				session_start();
				$_SESSION['username'] = $results['nom'];
				$_SESSION['role'] = $results['role'];
				header('Location:../view/frames.htm');
				exit;
			}else{
				$errMsg .= 'Utilisateur non existant';
				header('Location:../view/erreur.php?err='.$errMsg);
				exit;
			}
		}
    }
}

//Affichage et formattage des données
function displayData($sQuery,$fieldArray,$fieldNameArray,$link){
$couleur="";
$add_couleur="";
//$c_e_f=0;

$dbCon=connectDb();
$result=$dbCon->query($sQuery);
echo '<table class="table table-striped">';
foreach($fieldNameArray as $field)	echo '<th class="active blue_fonce">'.$field.'</th>';
while($data=$result->fetch()){

    //if(verifierExistanceKey("facturation", "client_id", $data['id'])<=1){







    echo '<tr class='.$couleur.'>';
    //echo $data['fc_id'];
	foreach($fieldArray as $field){

	if($data[$field]==$data[$link]){
	$addLeftLinkTag='<a href="../client/client.php?client_id=';
	$addLeftLinkTag.=$data['id'];
	$addLeftLinkTag.='">';
    $addRightLinkTag='</a>';
	$Link="";
	$Link.=$addLeftLinkTag;
	$Link.=$data[$field];
	$Link.=$addRightLinkTag;
	(isset($data['adresse_c'])) ? $Link.= "<br>".getAdressDetails($data['adresse_c']):"";
	echo "<td>".$Link."</td>";
	}else if(isset($data['bp']) && isset($data['date_e_f'])){
		$string="";
		if($data[$field]==$data['bp']){
		$string= getAbonnementBp($data['bp']).'('.$data['bp'].')';

		}else if($data[$field]==$data['date_e_f']){

		$date_e_f=$data['date_exp'];
		$string= $data['date_e_f'].' ('.notifyExpiryDate($date_e_f).')';
		}
	echo "<td>".$string."</td>";

	}else{

	echo '<td class='.$add_couleur.'>'.$data[$field].'</td>';
	}
	}
	echo '</tr>';

	}//}
echo '</table>';
}

//----------------------------------------------------------------------------------------------------------------------

//Affichage et formattage des données
function displaySingleData($sQuery,$fieldArray,$link){
	$dbCon=connectDb();
	$result=$dbCon->query($sQuery);
    //$cl_id=0;
	while($data=$result->fetch()){
		$cl_id=$data['id'];
        //echo $cl_id;
		foreach($fieldArray as $field){

			if($data[$field]==$data[$link]){
				$Link="";
				$Link.=$data[$field];
				(isset($data['adresse_c'])) ? $Link.= "<br/><br><strong>Adresse : </strong><br/>".getAdressDetails($data['adresse_c']):"";
				echo $Link;
			}else if(isset($data['bp']) && isset($data['date_e_f'])){
				$string="";
				if($data[$field]==$data['bp']){
					$string="<br/><br/><strong>Abonnement : </strong><br/>";
					$string.= getAbonnementBp($data['bp']).'('.$data['bp'].')';

				}else if($data[$field]==$data['date_e_f']){

					$date_e_f=$data['date_exp'];
					$string="<br/><br/><strong>Date expiration abonnement : </strong><br/>";
					$string.= $data['date_e_f'].' ('.notifyExpiryDate($date_e_f).')';
					$string.=(notifyExpiryDate($date_e_f)=="<span style='color:red;'>Abonnement expiré!</span>")?
							"<br/><br/>
                            <button class=\"btn btn-danger\" onclick=\"renouvellerAbnm()\" id=\"printF\">Renouveller abonnement</button>
                            <script type='text/javascript'>
                            function renouvellerAbnm(){
                            window.location=\"../abonnement/renouveller_abonnement.php?cl_id=".$cl_id."\";}</script>":"";
				}
				echo $string;
			}else{
				echo $data[$field];
			}
		}
        echo '<br><br><button class="btn btn-primary" onclick="printFacture()" id="printF">Imprimer facture</button>
                <script type=\'text/javascript\'>
                function printFacture(){
                window.location=\'../facturation/facture.php?new&cl_id='.$cl_id.'\';
                }
                </script>';
}

}
//----------------------------------------------------------------------------------------------------------------------

//Recheche dans la base

//Get an element by any else
function getFieldFromAnyElse($table ,$fwhName, $fwh , $ftg){

  $sQuery="SELECT ".$ftg;
  $sQuery.=" FROM ".$table;
  $sQuery.=" WHERE ".$fwhName;
  $sQuery.=" =? ";

  $dbCon=connectDb();
  $pQuery=$dbCon->prepare($sQuery);
  $pQuery->execute(array($fwh));

  $resultSet=$pQuery->fetch();

  return $resultSet[$ftg];

}

//Verifie l'existance
function verifierExistanceKey($table, $field, $keyValue){

  $sQuery="SELECT *";
  $sQuery.=" FROM ".$table;
  $sQuery.=" WHERE ".$field."=?";

  $compteur=0;
  $databaseConnection=connectDb();
  $result = $databaseConnection->prepare($sQuery);
  $result->execute(array($keyValue));
  $compteur=$result->rowCount();
  $result->closeCursor();
  return $compteur;
}

function cryptPw($pw){
	return sha1(md5(sha1($pw)));
}

//String manupulation functions
//By biohazard dot ge at gmail dot com
//From PHP Documentation, about substr_replace : user contributors
function after ($this, $inthat){
         if (!is_bool(strpos($inthat, $this)))
         return substr($inthat, strpos($inthat,$this)+strlen($this));
}
function after_last ($this, $inthat) {
         if (!is_bool(strrevpos($inthat, $this)))
         return substr($inthat, strrevpos($inthat, $this)+strlen($this));
}
function before ($this, $inthat){
         return substr($inthat, 0, strpos($inthat, $this));
}
function before_last ($this, $inthat){
         return substr($inthat, 0, strrevpos($inthat, $this));
}
function between ($this, $that, $inthat){
         return before ($that, after($this, $inthat));
}
function between_last ($this, $that, $inthat){
      return after_last($this, before_last($that, $inthat));
}
// use strrevpos function in case your php version does not include it
function strrevpos($instr, $needle){
     $rev_pos = strpos (strrev($instr), strrev($needle));
     if ($rev_pos===false) return false;
     else return strlen($instr) - $rev_pos - strlen($needle);
 }
//------------------------------------------------------------------------------

function getAdressDetails($adress){

$prov= trim(between(':',',', $adress));
$adress=substr($adress, 13+strlen($prov), strlen($adress));
$ville=trim(between(':',',', $adress));
$aPhy=after_last(':', $adress);
$aPhy=before('}', $aPhy);

//return array($prov, $ville, $aPhy);
return $prov.",".$ville."<br>".$aPhy;
}

function getContactsDetails($contact, $type){

$tel=trim(between(':',',',$contact));
$mail=trim(before('}',(after_last(":", $contact))));

//return array($tel, $mail);
return ($type=="mail")? $mail:$tel;
//return "Phone: ".$tel.", Electronique: ".$mail;
}

//function check session validity
function checkSessionValidity(){
if(!(isset($_SESSION['username']))) header('Location:../../index.php');
}
//
function getAbonnementBp($volAbnmt){

$volAbnmt=trim($volAbnmt);
$bp=(int)(before("/",$volAbnmt))+(int)(after("/",$volAbnmt));
return $bp;

}
//
function notifyExpiryDate($date_e_f){

	$msg="";

	$today=date("Y-m-d");
	$today=date_create($today);
	$date_e_f=date_create($date_e_f);
	$interval=date_diff($today, $date_e_f);
	$interval=(int)$interval->format('%a');
	if($today<$date_e_f){
	($interval<7 ) ? $msg="<span style='color:red;'>Plus que ".$interval." jours</span>" :
                     $msg="<span style='color:green;'>Encore ".$interval." jours</span>";
	}else{
	$msg="<span style='color:red;'>Abonnement expiré!</span>";
	}


	return $msg;


}


function actionClose($lougoutPagePath){
?>
<div class="col-lg-1 col-md-1 col-sm-1">
<?php if(isset($_SESSION['role'])){ ?>
<button onClick="logout()" class="btn btn-danger">X</button></div>
<?php } ?>
</div>
<script type="text/javascript">
	function logout(){
		var q=confirm("Quitter le programme?");
		if(q){
			 window.location='<?php echo $lougoutPagePath."logout.php";?>';
			 }else{
				 return;
			}
				}
</script>

<?php
}
?>

<?php
function getHeader($logoPath, $lougoutPagePath){
?>
<div id="header" class="row">
<div class="col-lg-1 col-lg-offset-3 col-md-1 col-md-offset-3 col-sm-1 col-sm-offset-3">
<img src="<?php echo $logoPath."logo.jpg";?>" height="100px" width="100px">
</div>
<div class="col-lg-4  col-lg-offset-1 col-md-4 col-md-offset-1 col-sm-3 col-sm-offset-1" id="bt_title">
<h1 class="titre">Atom System</h1>
</div>
<div class="col-lg-1 col-md-1 col-sm-1">
<?php if(isset($_SESSION['role'])){ ?>
<button onClick="logout()" class="btn btn-danger">X</button></div>
<?php } ?>
</div>
<script type="text/javascript">
	function logout(){
		var q=confirm("Quitter le programme?");
		if(q){
			 window.location='<?php echo $lougoutPagePath."logout.php";?>';
			 }else{
				 return;
			}
				}
</script>
<div class="row">
	<div class="col-lg-5 bg-default col-lg-offset-5 bg-default col-md-offset-5 col-md-5  col-sm-offset-5 col-sm-5">
    <?php if(isset($_SESSION['fonction'])){ ?>
	<h2 class="title"><?php echo (($_SESSION['fonction']=="Rec")? "Réception":"Kinésithérapie");?></h2>
    <?php } ?>
	</div>
</div>
<?php
}

//gennerate Numero Factures
function genererNumFacture(){
  $numero_facture="0";
  $nombre_f=0;
  $databaseConnection=connectDb();
  $sQuery="SELECT COUNT(id) AS nombre_f";
  $sQuery.=" FROM facturation";
  $sQuery.=" WHERE ? ";

  $databaseConnection=connectDb();
  $pQuery=$databaseConnection->prepare($sQuery);
  $pQuery->execute(array(1));

  $resultSet=$pQuery->fetch();

  $nombre_f=(int)$resultSet['nombre_f'];

  $pQuery->closeCursor();

  $nombre_f+=1;
  ($nombre_f<10) ? $numero_facture=$numero_facture.$nombre_f:$numero_facture=$nombre_f;

  return $numero_facture;
}

function readIniParam($cf,$ip){

$a=parse_ini_file($cf);

return $a[$ip];

}

?>
