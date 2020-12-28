<?php
session_start();
include('../../control/functions.php');
checkSessionValidity();
if(isset($_POST['page'])){
//Include pagination class file
include('../pagination/Pagination.php');

echo '<meta charset="utf-8">';
echo '<link type="text/css" rel="stylesheet" href="../style/css/style.css"/>';

$start = !empty($_POST['page'])?$_POST['page']:0;
$limit = 3;

//Getting here the number of entries in our database table
$countFacturations="SELECT * FROM facturation";
$dbCon=connectDb();
$pQuery=$dbCon->prepare($countFacturations);
$pQuery->execute();
//Here it is
$rowCount=$pQuery->rowCount();
$pQuery->closeCursor();

//initialize pagination class
$pagConfig = array('baseURL'=>'getData.php', 'totalRows'=>$rowCount, 'currentPage'=>$start, 'perPage'=>$limit, 'contentDiv'=>'posts_content');
$pagination =  new Pagination($pagConfig);

//***********************************************************************************************************************

//***********************************************************************************************************************
$sQuery="SELECT client.nom AS nom_c, DATE_FORMAT(facturation.date, '%d/%m/%Y') AS date_f, abonnement.volume AS bp, ";
$sQuery.="client.adresse AS adresse_c, DATE_FORMAT(DATE_ADD(facturation.date, INTERVAL 1 MONTH), '%d/%m/%Y') AS date_e_f,
          DATE_ADD(facturation.date, INTERVAL 1 MONTH) AS date_exp, client.id AS id, abonnement.id AS aid ";
$sQuery.="FROM client, facturation, abonnement ";
$sQuery.="WHERE facturation.client_id=client.id ";
$sQuery.="AND facturation.abonnement_id=abonnement.id ";
$sQuery.="ORDER BY facturation.date DESC ";
$sQuery.="LIMIT ".$start.", ".$limit;

$fieldArray=array("nom_c", "bp", "date_e_f","id");
$fieldNameArray=array("Clients","Abonnement","Prochaine facturation", "ID Client");

displayData($sQuery,$fieldArray,$fieldNameArray,"nom_c");
//***********************************************************************************************************************

//******************************
    if($query->num_rows > 0){ ?>
        <div class="posts_list">
        <?php
            while($row = $query->fetch_assoc()){
                $postID = $row['id'];
        ?>
            <div class="list_item"><a href="javascript:void(0);"><h2><?php echo $row["title"]; ?></h2></a></div>
        <?php } ?>
        </div>
        <?php echo $pagination->createLinks(); ?>
<?php }

}?>
