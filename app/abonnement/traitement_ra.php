<?php
/**
 * Created by PhpStorm.
 * User: Marcellin DBFX
 * Date: 19/10/2016
 * Time: 21:26
 */
include "../../control/functions.php";
echo "hello word!";
if(isset($_POST['nom_c'])){

    $nom=getField($_POST['nom_c']);
    $volume=getField($_POST['volumeUD']);

    $ab_id=getFieldFromAnyElse("abonnement", "volume",$volume,"id");
    $cl_id=getFieldFromAnyElse("client", "nom", $nom,"id");

    insertFacturation($cl_id,$ab_id);

    header('Location:../client/enregistrer_client.php?not_in&msg');

}else{

    echo "Echec";
}