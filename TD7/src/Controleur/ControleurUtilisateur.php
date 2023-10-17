<?php

namespace App\Covoiturage\Controleur;
use App\Covoiturage\Modele\DataObject\Utilisateur as Utilisateur;
use App\Covoiturage\Modele\HTTP\Cookie;
use App\Covoiturage\Modele\Repository\UtilisateurRepository as UtilisateurRepository;



class ControleurUtilisateur extends ControleurGenerique {




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

    public static function afficherFormulaireCreation() : void{
        ControleurUtilisateur::afficherVue('vueGenerale.php' , ["pagetitle" => "Formulaire création utilisateur" ,"cheminVueBody" => 'utilisateur/formulaireCreation.php']);
    }

    public static function afficherFormulaireMiseAJour() : void{
        $login = $_GET['login'];
        $utilisateur = (new UtilisateurRepository())->recupererParClePrimaire($login);
        ControleurUtilisateur::afficherVue('vueGenerale.php', ['utilisateur' => $utilisateur, "pagetitle"=>"MAJ",
            "cheminVueBody" => 'utilisateur/formulaireMiseAJour.php']);
    }
    public static function mettreAJour() : void {
        $utilisateur = new Utilisateur($_GET['login'], $_GET['nom'], $_GET['prenom']);
        (new UtilisateurRepository())->mettreAJour($utilisateur);
        $utilisateurs = (new UtilisateurRepository())->recuperer();
        ControleurUtilisateur::afficherVue('vueGenerale.php', ['utilisateurs' => $utilisateurs, "pagetitle" => "Utilisateur modifié", "cheminVueBody"=> 'utilisateur/utilisateurMiseAJour.php', 'login' => $utilisateur->getLogin()]);
    }

    public static function creerDepuisFormulaire() : void{
        $modUtilisateur= new Utilisateur($_GET['login'], $_GET['nom'], $_GET['prenom']);
        $accepter = (new UtilisateurRepository())->sauvegarder($modUtilisateur);
        $utilisateurs = (new UtilisateurRepository())->recuperer();
        ControleurUtilisateur::afficherVue('vueGenerale.php' ,['utilisateurs' => $utilisateurs ,"pagetitle"=>"Utilisateur créé", "cheminVueBody" => 'utilisateur/utilisateurCree.php']);
    }

    /*public static function deposerCookie(){
        (new Cookie())->enregistrer("oulala", 123, 0);
    }

    public static function lireCookie(){
        if((new Cookie())->contient("oulala") == true)
        echo (new Cookie())->lire("oulala");
        else{
            echo "erreur cookie";
        }
    }

    public static function ripCookie(){
        (new Cookie())->supprimer("oulala");
        self::lireCookie();
    }*/

}

?>