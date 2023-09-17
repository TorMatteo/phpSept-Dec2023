<?php
    require_once ("Model.php");
    require_once ("Trajet.php");
    require_once ("Utilisateur.php");

foreach (Trajet::getPassagers($_GET['id']) as $passager){
    echo $passager;
}
?>
