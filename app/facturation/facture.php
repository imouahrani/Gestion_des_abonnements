<?php
session_start();
include '../../control/functions.php';
checkSessionValidity();
if(!($_SESSION['role']=="Simple")){
  header('Location:../../index.php');
}

$fa_id=0;
$cl_id=0;

if(isset($_GET['cl_id'])){
  $cl_id=$_GET['cl_id'];

  $sQuery="SELECT id ";
  $sQuery.="FROM facturation ";
  $sQuery.="WHERE client_id=? ";
  $sQuery.="ORDER BY id DESC LIMIT 1";

  $dbCon=connectDb();
  $pQuery=$dbCon->prepare($sQuery);
  $pQuery->execute(array($cl_id));
  $data=$pQuery->fetch();

  $fa_id=$data['id'];
}

$n_c="";
$address="";
$contact="";

$cf="../../control/init.ini";
$taux_USD_CDF =(is_file($cf))? readIniParam($cf, "taux_USD_CDF"):1000;
$pu =(is_file($cf))? readIniParam($cf, "prix_unitaire_BLR"):475.0;
$tva =(is_file($cf))? readIniParam($cf, "tva"):0.16;

$numero_facture=genererNumFacture();
$date_e_f=date('d/m/Y');
$ab=0;
$up=0;
$down=0;
$dda="";
$dfa="";

//$fa_id=1;
if(!($fa_id==0)){

$sQuery="SELECT client.nom AS nom_c, DATE_FORMAT(facturation.date, '%d/%m/%Y') AS date_f, abonnement.volume AS bp, ";
$sQuery.="client.adresse AS adresse_c, DATE_FORMAT(DATE_ADD(facturation.date, INTERVAL 1 MONTH), '%d/%m/%Y') AS date_e_f,
          DATE_ADD(facturation.date, INTERVAL 1 MONTH) AS date_exp, client.id AS id, client.contact AS contact_c ";
$sQuery.="FROM client, facturation, abonnement ";
$sQuery.="WHERE facturation.client_id=client.id ";
$sQuery.="AND facturation.abonnement_id=abonnement.id ";
$sQuery.="AND facturation.id=".$fa_id;

$dbCon=connectDb();
$pQuery=$dbCon->prepare($sQuery);
$pQuery->execute();

while ($data=$pQuery->fetch()) {
$n_c=$data['nom_c'];
$address=$data['adresse_c'];
$contact=$data['contact_c'];
$ab=$data['bp'];
$pt=getAbonnementBp($ab)*$pu;
$up=(int)(before("/",$ab));
$down=(int)(after("/",$ab));
$dda=$data['date_f'];
$dfa=$data['date_e_f'];
}
}
//------------------------------------------------------------------------------------------------
if(isset($_GET['new'])){
if(!($fa_id==0)){
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Facture</title>
<link type="text/css" rel="stylesheet" href="../../view/ressources/style/css/style.css"/>
<link type="text/css" rel="stylesheet" href="../../view/ressources/style/bootstrap/css/bootstrap.css"/>
<link type="text/css" rel="stylesheet" href="../../view/ressources/style/bootstrap/css/bootstrap-theme.css"/>
<style type="text/css">
table{

  border-collapse:collapse;
}
table, tr, td{
  border: solid #012 2px;
}
body{
  font-size:13px;
  font-family: Segoe, "Segoe UI", "DejaVu Sans", "Trebuchet MS", Verdana, sans-serif;
}
</style>
</head>
<div class="container">
  <div class="row">
    <div class="col-lg-10">

      <table width="612" height="1017" border="1" cellpadding="1">
        <tr>
          <td height="105" colspan="10"><p><img src="../../view/ressources/images/banner.PNG"></p></td>
        </tr>
        <tr>
          <td colspan="7" rowspan="2">RCCM: CD/KIN/RCCM/14-B-5883 ID Nat: N6968H. N° IMPOT: A1217016K<br/>
Siège Social: Avenue de la justice n° 54<br/>
Immeuble MAK'S - IMMO, 4ème Niveau<br/>
Kinshasa - Gombe<br/>
R.D. CONGO</td>
          <td colspan="3">CLIENT: <?php echo $n_c;?><br/></td>
          </tr>
          <tr>
            <td colspan="3">ADRESSE<br/>
Physique:<?php echo getAdressDetails($address);?></td>
          </tr>
            <tr>
              <td colspan="7" rowspan="2">Tél: +243(0)81 761 1087,+243(0)99 947 6306<br>
              marleykiadi@gmail.com/kiadimarley@atomsystem.net</td>
              <td height="49" colspan="3">
                CONTACTS<br/>
                Phone: <?php echo getContactsDetails($contact, "phone");?><br/>
                Electronique: <?php echo getContactsDetails($contact, "mail");?><br/></td>
              </tr>
              <tr>
                <td width="67" height="13"></td>
                <td width="90">Numéro</td>
                <td width="37">Date</td>
              </tr>
              <tr>
                <td height="13" colspan="8">FACTURE</td>
                <td height="13"><?php echo genererNumFacture();?></td>
                <td height="13"><?php echo $date_e_f=date('d/m/Y');?></td>
              </tr>
              <tr>
                <td colspan="10">MODALITE DE PAIEMENT: PAIEMENT MENSUEL ET ANTICIPATIF ECHEANCE: </td>
              </tr>
              <tr>
                <td colspan="10">COORDONNEES BANCAIRES:<br/>
                  TRUST MERCHANT BANK S.A.R.L / TMB<br/>
                  COMPTES BANCAIRES: -1201-5028606-00-84 USD _____-1201-5028606-01-85 CDF<br/>
                  DOIT POUR CE QUI SUIT:<br/></td>
                </tr>
                <tr>
                  <td width="71">CODE</td>
                  <td colspan="6">DESCRIPTION DU PRODUIT</td>
                  <td>QUANTITE</td>
                  <td>Prix Unitaire</td>
                  <td>Prix Total</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td height="209" colspan="6"><p>ABONNEMENT SERVICE INTERNET:</p>
                    <p>CONNEXION BLR: </p>
                    <p><?php echo $up." Kbps downlink / ".$down." Kbps uplink";?></p>
                    <p>Période de facturation:</p>
                    <p>Du :<?php echo $dda;?><br>
                  Au : <?php echo $dfa;?>	</p></td>
                  <td><?php echo getAbonnementBp($ab);?></td>
                  <td><?php echo $pu;?></td>
                  <td><?php echo $pt;?></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td width="367" height="23">&nbsp;</td>
                  <td colspan="5">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="10"></td>
                </tr>
                <tr>
                  <td colspan="8"></td>
                  <td>TOTAL H.T.<br/>
                    T.V.A.(16%) <br/></td>
                  <td><?php echo $pt; ?>
                  <br><?php echo $pt*$tva; ?></td>
                  </tr>
                  <tr>
                    <td colspan="6">SOIT USD :<?php echo "  <strong>".($pt*$tva+$pt)/$taux_USD_CDF." </strong>";?></td>
                    <td colspan="2">TOTAL A PAYER</td>
                    <td>TOTAL TTC</td>
                    <td><?php echo $pt*$tva+$pt; ?></td>
                  </tr>
                  <tr>
                    <td colspan="8" rowspan="2">POUR ATOM SYSTEM SPRL<br/><br/><br/>
                      Chef de Division Financière<br/></td>
                      <td colspan="2">&nbsp;</td>
                      </tr>
                  <tr>
                    <td height="31" colspan="2"> facture definitive</td>
                  </tr>
                    </table>
    </div>
                </div>
                <button class="btn btn-primary" id="printF">Imprimer facture</button>
                <script src="../../view/ressources/style/bootstrap/js/jquery.min.js"></script>
              </div>
              <script src="../style/jquery/jquery.js"></script>
     		<script>
				
              $(document).ready(function() {
                $("#printF").click(function() {
				  $('#printF').css('display','none');
				  window.print();
                  window.location="../client/enregistrer_Client.php?not_in";
                });
              });
              </script>
            </body>
            </html>
<?php
}else{
  echo '<meta charset="utf-8">';
  echo '<script type="text/javascript">
    alert("Aucun client selectionné");
  </script>';
}
}
?>
