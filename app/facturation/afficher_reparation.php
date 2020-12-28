<?php
session_start();
include('../../control/functions.php');
checkSessionValidity();

$countFacturations="SELECT * FROM facturation";

$dbCon=connectDb();

$pQuery=$dbCon->prepare($countFacturations);
$pQuery->execute();
$rowCount=$pQuery->rowCount();
///echo $rowCount;
$pQuery->closeCursor();

//******************************************************************************
//Inspired from an article on developpez.com

$itemByPage=5;

$allItems=$rowCount;

$numberOfPages=ceil($allItems/$itemByPage);

if(isset($_GET['page'])){
     $currentPage=intval($_GET['page']);

     if($currentPage>$numberOfPages)
     {
          $currentPage=$numberOfPages;
     }
}else
{
     $currentPage=1;
}

$firstItem=($currentPage-1)*$itemByPage;

//******************************************************************************

//******************************************************************************



$sQuery="SELECT client.nom AS nom_c, facturation.date AS date_f, abonnement.volume AS bp ";
$sQuery.="FROM client, facturation, abonnement ";
$sQuery.="WHERE facturation.client_id=client.id ";
$sQuery.="AND facturation.abonnement_id=abonnement.id ";
$sQuery.="ORDER BY facturation.date DESC ";
$sQuery.="LIMIT ".$firstItem.", ".$itemByPage;

$pQuery=$dbCon->prepare($sQuery);
$pQuery->execute();

while ($data=$pQuery->fetch()) {

    echo $data['nom_c']." | ".$data['date_f']." | ".$data['bp']."<br>";

}
$pQuery->closeCursor();

//******************************
/*
echo '<p align="center">Page : '; //Pour l'affichage, on centre la liste des pages
for($i=1; $i<=$numberOfPages; $i++) //On fait notre boucle
{
     //On va faire notre condition
     if($i==$currentPage) //Si il s'agit de la page actuelle...
     {
         echo ' [ '.$i.' ] ';
     }
     else //Sinon...
     {
          echo ' <a href="afficher_reparation.php?page='.$i.'">'.$i.'</a> ';
     }
}
echo '</p>';

echo $_SERVER['PHP_SELF'];
*/

	echo '<div align="center">';
	/* We call the pagination function here to generate Pagination link for us. 
	As you can see I have passed several parameters to the function. */
	echo paginate_function($itemByPage, $currentPage, $firstItem, $allItems);
	echo '</div>';

//*******************************

//echo $rowCount;

//------------------------------------------------------------------------------

/*$pages=array();

for($i=0; i<=$rowCount;$i++){
$i%2$page[$i]=($rowCount/3)+2;

}*/
/*$count="SELECT count(*) FROM facturation";
$pQuery=$dbCon->prepare($count);
$pQuery->execute();

$data=$pQuery->fetch();
$pQuery->closeCursor();

$rowCount= $data[0];*/
//**********************************************************************************

function paginate_function($item_per_page, $current_page, $total_records, $total_pages)
{
    $pagination = '';
    if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
        $pagination .= '<ul class="pagination">';
        
        $right_links    = $current_page + 3; 
        $previous       = $current_page - 3; //previous link 
        $next           = $current_page + 1; //next link
        $first_link     = true; //boolean var to decide our first link
        
        if($current_page > 1){
			$previous_link = ($previous==0)? 1: $previous;
            $pagination .= '<li class="first"><a href="#" data-page="1" title="First">&laquo;</a></li>'; //first link
            $pagination .= '<li><a href="#" data-page="'.$previous_link.'" title="Previous">&lt;</a></li>'; //previous link
                for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
                    if($i > 0){
                        $pagination .= '<li><a href="#" data-page="'.$i.'" title="Page'.$i.'">'.$i.'</a></li>';
                    }
                }   
            $first_link = false; //set first link to false
        }
        
        if($first_link){ //if current active page is first link
            $pagination .= '<li class="first active">'.$current_page.'</li>';
        }elseif($current_page == $total_pages){ //if it's the last active link
            $pagination .= '<li class="last active">'.$current_page.'</li>';
        }else{ //regular current link
            $pagination .= '<li class="active">'.$current_page.'</li>';
        }
                
        for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
            if($i<=$total_pages){
                $pagination .= '<li><a href="#" data-page="'.$i.'" title="Page '.$i.'">'.$i.'</a></li>';
            }
        }
        if($current_page < $total_pages){ 
				$next_link = ($i > $total_pages) ? $total_pages : $i;
                $pagination .= '<li><a href="#" data-page="'.$next_link.'" title="Next">&gt;</a></li>'; //next link
                $pagination .= '<li class="last"><a href="#" data-page="'.$total_pages.'" title="Last">&raquo;</a></li>'; //last link
        }
        
        $pagination .= '</ul>'; 
    }
    return $pagination; //return pagination links
}
