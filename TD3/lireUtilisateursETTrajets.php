<?php
    require_once ("Model.php");
    require_once ("Trajet.php");
    require_once ("Utilisateur.php");

    foreach (Utilisateur::getUtilisateurs() as $utilisateur){
        echo $utilisateur;
    }
    echo '<br>';
    foreach (Trajet::getTrajets() as $trajet){
        echo $trajet;
}
?>