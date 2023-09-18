<?php
    require_once ("Model.php");
    require_once ("Trajet.php");
    require_once ("Utilisateur.php");

    if(empty($_GET)){
        echo "ERROR BIP BOOP";
    }
    else{

        foreach (Trajet::getPassagers($_GET['id']) as $passager){
    echo $passager;
}
    }
?>
