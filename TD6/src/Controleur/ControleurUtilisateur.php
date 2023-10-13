<?php

namespace App\Covoiturage\Controleur;
use App\Covoiturage\Modele\DataObject\Utilisateur as Utilisateur;
use App\Covoiturage\Modele\Repository\UtilisateurRepository as UtilisateurRepository;



class ControleurUtilisateur {

    private static function afficherVue(string $cheminVue, array $parametres = []) : void {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require __DIR__ . "/../vue/$cheminVue"; // Charge la vue
    }


    // Déclaration de type de retour void : la fonction ne retourne pas de valeur
    public static function afficherListe() : void {
        $utilisateurs = (new UtilisateurRepository())->recuperer() ; //appel au modèle pour gerer la BD
        //ControleurVoiture::afficherVue('voiture/liste.php', ['voitures'=>$voitures]);  //"redirige" vers la vue
        ControleurUtilisateur::afficherVue('vueGenerale.php', ['utilisateurs'=>$utilisateurs, "pagetitle" => "Liste des utilisateurs", "cheminVueBody" => "utilisateur/liste.php"]);
    }

    public static function afficherErreur(string $messageErreur = ""){
        ControleurUtilisateur::afficherVue('utilisateur/erreur.php');
    }

    public static function afficherDetail() :void {
        $utilisateur = (new UtilisateurRepository())->recupererParClePrimaire($_GET['login']);
        ControleurUtilisateur::afficherVue('vueGenerale.php', ['utilisateur' => $utilisateur, "pagetitle" => "Details utilisateur", "cheminVueBody" => "utilisateur/detail.php"]);
    }

    public static function supprimer() : void {
        $login = $_GET['login'];
        (new UtilisateurRepository())->supprimer($login);
        $utilisateurs = (new UtilisateurRepository())->recuperer();
        ControleurUtilisateur::afficherVue('vueGenerale.php' ,
            ['utilisateurs' => $utilisateurs, 'login' => $login ,"pagetitle"=>"Uti suppr", "cheminVueBody" => 'utilisateur/utilisateurSupprimee.php']);
    }

}

?>