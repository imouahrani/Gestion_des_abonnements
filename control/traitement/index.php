<?php

session_start();
include('../functions.php');
include('../../app/client/Client.class.php');
include('../../app/abonnement/Abonnement.class.php');
include('../../app/utilisateur/Utilisateur.class.php');

//if(isset($_POST['submit'])){
    
    if (isset($_GET['ttt'])){
       $action=getField($_GET['ttt']); 
       if($action=="eC"){
           
            $nom=getField($_POST['nom_c']);
                        
            $volume=getField($_POST['volumeUD']);
	
            $tel=getField($_POST['tel']);
            $email=getField($_POST['mail']);
            $contact="{";
            $contact.="tel : ".$tel;
            $contact.=",";
            $contact.="email : ".$email;
            $contact.="}";
            
            $province=getField($_POST['province']);
            $ville=getField($_POST['ville']);
            $ch_adresse=getField($_POST['ch_adresse']);
            $adresse="{";
            $adresse.="province : ".$province. ",";
            $adresse.="ville : ".$ville.",";
            $adresse.="adresse :".$ch_adresse."}";
            
            $abonnement_id=getFieldFromAnyElse("abonnement" ,"volume", $volume , "id");
                        
            $client = new Client($nom,$adresse,$contact);
            insertClient($client);            
            
            $nom=$client->getNom();
            $adresse=$client->getAdresse();
            $contact=$client->getContacts();
            
            $client_id=getClientId($nom, $adresse, $contact);
            insertFacturation($client_id, $abonnement_id);
            
            echo "Client enregistré";
            
       }else if($action=="eA"){
           
            $type=getField($_POST['type']);
            $volume=getField($_POST['volume']);
            $description=getField($_POST['description']);

            $ab = new Abonnement($type, $volume, $description);
            
            insertAbonnement($ab);
	
        }else if($action=="aU"){
           
            $nom=getField($_POST['nom_u']);
            $role=getField($_POST['role']);
            $user=getField($_POST['user_u']);
            $pass=cryptPw(getField($_POST['pass_u']));

            $u = new Utilisateur($nom, $role, $user, $pass);
            
            insertUtilisateur($u);
	
        }else if($action=="rC"){
           
         	$q = $_GET["q"];

	        $hint = "";
	
	        $sQuery="SELECT nom FROM clients";
            //Resultats de la DB
            $dbCon=connectDb();
            $sResult=$dbCon->query($sQuery);
            //$sResult->execute(array());
            
            // Recuperation des suggestions, si $q different de ""
            if ($q !== "") {
            $q = strtolower($q);
            $len=strlen($q);
            while($data=$sResult->fetch()) {
                $name=$data['nom'];
                if (stristr($q, substr($name, 0, $len))) {
                    if ($hint === "") {
                        $hint = '<a href= "../service/service.php?q='.$name.'">'.$name.'</a>';
                    } else {
                        $hint .= ', <a href= "../service/service.php?q='.$name.'">'.$name.'</a>';
                    }
                }
                
            }
        }

            /* Affichage d'un message si pas des suggestion */
            echo $hint === "" ? "</br>"."Aucune suggestion : Client non trouvé, veuillez l'enregistrer" : "Résultats : ". $hint;
	
        }else {
            echo "Echec enregistrement!";
        }
        
           
       }
    
    
