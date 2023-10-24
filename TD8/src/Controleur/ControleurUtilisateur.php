<?php

namespace App\Covoiturage\Controleur;

use App\Covoiturage\Lib\ConnexionUtilisateur;
use App\Covoiturage\Lib\MotDePasse;
use App\Covoiturage\Modele\DataObject\Utilisateur as Utilisateur;
use App\Covoiturage\Modele\HTTP\Cookie;
use App\Covoiturage\Modele\Repository\UtilisateurRepository as UtilisateurRepository;

use App\Covoiturage\Modele\HTTP\Session;

class ControleurUtilisateur extends ControleurGenerique
{


    // Déclaration de type de retour void : la fonction ne retourne pas de valeur
    public static function afficherListe(): void
    {
        $utilisateurs = (new UtilisateurRepository())->recuperer(); //appel au modèle pour gerer la BD
        //ControleurVoiture::afficherVue('voiture/liste.php', ['voitures'=>$voitures]);  //"redirige" vers la vue
        ControleurUtilisateur::afficherVue('vueGenerale.php', ['utilisateurs' => $utilisateurs, "pagetitle" => "Liste des utilisateurs", "cheminVueBody" => "utilisateur/liste.php"]);
    }

    public static function afficherErreur(string $messageErreur)
    {
        ControleurUtilisateur::afficherVue('utilisateur/erreur.php', ["pagetitle" => "ERROR", "messError" => $messageErreur]);
    }

    public static function afficherDetail(): void
    {
        $utilisateur = (new UtilisateurRepository())->recupererParClePrimaire($_GET['login']);
        ControleurUtilisateur::afficherVue('vueGenerale.php', ['utilisateur' => $utilisateur, "pagetitle" => "Details utilisateur", "cheminVueBody" => "utilisateur/detail.php"]);
    }

    public static function supprimer(): void
    {
        $login = $_GET['login'];
        (new UtilisateurRepository())->supprimer($login);
        $utilisateurs = (new UtilisateurRepository())->recuperer();
        ControleurUtilisateur::afficherVue('vueGenerale.php',
            ['utilisateurs' => $utilisateurs, 'login' => $login, "pagetitle" => "Uti suppr", "cheminVueBody" => 'utilisateur/utilisateurSupprimee.php']);
    }

    public static function afficherFormulaireCreation(): void
    {
        ControleurUtilisateur::afficherVue('vueGenerale.php', ["pagetitle" => "Formulaire création utilisateur", "cheminVueBody" => 'utilisateur/formulaireCreation.php']);
    }

    public static function afficherFormulaireMiseAJour(): void
    {

        $login = $_GET['login'];
        $utilisateur = (new UtilisateurRepository())->recupererParClePrimaire($login);
        if ($utilisateur) {
            if ($_GET['login'] == ConnexionUtilisateur::getLoginUtilisateurConnecte()) {
                ControleurUtilisateur::afficherVue('vueGenerale.php', ['utilisateur' => $utilisateur, "pagetitle" => "MAJ",
                    "cheminVueBody" => 'utilisateur/formulaireMiseAJour.php']);
            } else {
                self::afficherErreur("pas de hackeurs sur mon site");

            }
        } else {
            self::afficherErreur("utilisateur n'existe pas");
        }
    }

    public static function mettreAJour(): void
    {
        $utiVerif = (new UtilisateurRepository())->recupererParClePrimaire($_GET['login']);
        if (MotDePasse::verifier($_GET['mdp3'], $utiVerif->getMdpHache())) {
            if ($_GET['mdp'] == $_GET['mdp2']) {
                $utilisateur = Utilisateur::construireDepuisFormulaire(array($_GET['login'], $_GET['nom'], $_GET['prenom'], $_GET['mdp']));
                (new UtilisateurRepository())->mettreAJour($utilisateur);
                $utilisateurs = (new UtilisateurRepository())->recuperer();
                ControleurUtilisateur::afficherVue('vueGenerale.php', ['utilisateurs' => $utilisateurs, "pagetitle" => "Utilisateur modifié", "cheminVueBody" => 'utilisateur/utilisateurMiseAJour.php', 'login' => $utilisateur->getLogin()]);

            } else {
                self::afficherErreur("erreur mdp nouveau et conf !=");

            }
        } else {
            self::afficherErreur("erreur ancien mdp");
        }

    }

    public static function creerDepuisFormulaire(): void
    {
        if ($_GET['mdp'] == $_GET['mdp2']) {
            $modUtilisateur = Utilisateur::construireDepuisFormulaire(array($_GET['login'], $_GET['nom'], $_GET['prenom'], $_GET['mdp']));
            $accepter = (new UtilisateurRepository())->sauvegarder($modUtilisateur);
            $utilisateurs = (new UtilisateurRepository())->recuperer();
            ControleurUtilisateur::afficherVue('vueGenerale.php', ['utilisateurs' => $utilisateurs, "pagetitle" => "Utilisateur créé", "cheminVueBody" => 'utilisateur/utilisateurCree.php']);
        } else {
            self::afficherErreur("mdp erreur");
        }
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

    public static function sessionOPEN()
    {
        $session = Session::getInstance();
        $session->enregistrer("utilisateur", "Cathy Penneflamme");
        echo $session->lire("utilisateur");

        // Start a session
        $session->enregistrer('name', 'John');
        echo "Session started. <br>";

        // Write and read session variables
        $session->enregistrer('age', 30);
        $session->enregistrer('hobbies', ['reading', 'swimming', 'traveling']);
        echo "Name: " . $session->lire('name') . "<br>";
        echo "Age: " . $session->lire('age') . "<br>";
        echo "Hobbies: ";
        print_r($session->lire('hobbies'));
        echo "<br>";

        // Delete a session variable
        $session->supprimer('age');
        echo "Age deleted. <br>";

        // Destroy the session
        $session->detruire();
        echo "Session destroyed. <br>";
    }

    public static function afficherFormulaireConnexion()
    {
        ControleurUtilisateur::afficherVue('vueGenerale.php', ["pagetitle" => "Formulaire connexion utilisateur", "cheminVueBody" => 'utilisateur/formulaireConnexion.php']);
    }

    public static function connecter()
    {
        if (isset($_GET['login']) || isset($_GET['mdp'])) {
            $utiVerif = (new UtilisateurRepository())->recupererParClePrimaire($_GET['login']);
            if (MotDePasse::verifier($_GET['mdp'], $utiVerif->getMdpHache())) {
                ConnexionUtilisateur::connecter($_GET['login']);
                ControleurUtilisateur::afficherVue('vueGenerale.php', ["pagetitle" => "Connecté", "cheminVueBody" => 'utilisateur/utilisateurConnecte.php', 'utilisateur' => $utiVerif]);
            } else {
                self::afficherErreur("Login inconnu");
            }
        } else {
            self::afficherErreur("Login et/ou mot de passe manquant.");
        }
    }

    public static function deconnecter()
    {
        ConnexionUtilisateur::deconnecter();
        $utilisateurs = (new UtilisateurRepository())->recuperer();
        ControleurUtilisateur::afficherVue('vueGenerale.php', ["pagetitle" => "deconnection", "cheminVueBody" => "utilisateur/utilisateurDeconnecte.php", "utilisateurs" => $utilisateurs]);
    }
}

?>