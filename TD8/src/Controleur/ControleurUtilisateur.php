<?php

namespace App\Covoiturage\Controleur;

use App\Covoiturage\Lib\ConnexionUtilisateur;
use App\Covoiturage\Lib\MotDePasse;
use App\Covoiturage\Lib\VerificationEmail;
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

        /*$login = $_GET['login'];
        (new UtilisateurRepository())->supprimer($login);
        $utilisateurs = (new UtilisateurRepository())->recuperer();
        ControleurUtilisateur::afficherVue('vueGenerale.php',
            ['utilisateurs' => $utilisateurs, 'login' => $login, "pagetitle" => "Uti suppr", "cheminVueBody" => 'utilisateur/utilisateurSupprimee.php']);*/
        $utiVerif = (new UtilisateurRepository())->recupererParClePrimaire($_GET['login']);
        if ($utiVerif) {
            if ($utiVerif->getLogin() == Session::getInstance()->lire('_utilisateurConnecte') || ConnexionUtilisateur::estAdministrateur()) {
                (new UtilisateurRepository())->supprimer($_GET['login']);
                $utilisateurs = (new UtilisateurRepository())->recuperer();
                ControleurUtilisateur::afficherVue('vueGenerale.php',
                    ['utilisateurs' => $utilisateurs, 'login' => $_GET['login'], "pagetitle" => "Uti suppr", "cheminVueBody" => 'utilisateur/utilisateurSupprimee.php']);
            } else {
                self::afficherErreur("mauvais compte");
            }
        } else {
            self::afficherErreur("erreur uti existe pas");
        }
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
            if ($_GET['login'] == ConnexionUtilisateur::getLoginUtilisateurConnecte() || ConnexionUtilisateur::estAdministrateur()) {
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
        if (ConnexionUtilisateur::estAdministrateur()) {
            $uti = (new UtilisateurRepository())->recupererParClePrimaire($_GET['login']);
            if($uti) {
                $estAdmin = isset($_GET['estAdmin']) ? 1 : 0;
                var_dump($estAdmin);
                $utilisateur = Utilisateur::construireDepuisFormulaire(array($_GET['login'], $_GET['nom'], $_GET['prenom'], $uti->getMdpHache(), $estAdmin));
                (new UtilisateurRepository())->mettreAJour($utilisateur);
                if ($estAdmin == 1) {
                    $utilisateur->setEstAdmin(true);
                } else {
                    $utilisateur->setEstAdmin(false);
                }
                $utilisateurs = (new UtilisateurRepository())->recuperer();
                ControleurUtilisateur::afficherVue('vueGenerale.php', ['utilisateurs' => $utilisateurs, "pagetitle" => "Utilisateur modifié", "cheminVueBody" => 'utilisateur/utilisateurMiseAJour.php', 'login' => $utilisateur->getLogin()]);
            }
            else{
                self::afficherErreur("login existe pas");
            }
        } else {
            if ((!empty($_GET['nom']) || !empty($_GET['prenom']) || !empty($_GET['mdp']) || !empty($_GET['mdp2']) || !empty($_GET['mdp3']))) {
                $utiVerif = (new UtilisateurRepository())->recupererParClePrimaire($_GET['login']);
                if ($utiVerif) {
                    if ($utiVerif->getLogin() == Session::getInstance()->lire('_utilisateurConnecte')) {
                        if (MotDePasse::verifier($_GET['mdp3'], $utiVerif->getMdpHache())) {
                            if ($_GET['mdp'] == $_GET['mdp2']) {
                                $mdp = MotDePasse::hacher($_GET['mdp']);
                                $estAdmin = isset($_GET['estAdmin']) ? 1 : 0;
                                $utilisateur = Utilisateur::construireDepuisFormulaire(array($_GET['login'], $_GET['nom'], $_GET['prenom'], $mdp, $estAdmin));
                                (new UtilisateurRepository())->mettreAJour($utilisateur);
                                if ($estAdmin == 1) {
                                    $utilisateur->setEstAdmin(true);
                                } else {
                                    $utilisateur->setEstAdmin(false);
                                }
                                $utilisateurs = (new UtilisateurRepository())->recuperer();
                                ControleurUtilisateur::afficherVue('vueGenerale.php', ['utilisateurs' => $utilisateurs, "pagetitle" => "Utilisateur modifié", "cheminVueBody" => 'utilisateur/utilisateurMiseAJour.php', 'login' => $utilisateur->getLogin()]);

                            } else {
                                self::afficherErreur("erreur mdp nouveau et conf !=");

                            }
                        } else {
                            self::afficherErreur("erreur ancien mdp");
                        }
                    } else {
                        self::afficherErreur("mauvais compte");
                    }
                } else {
                    self::afficherErreur("erreur uti existe pas");
                }
            } else {
                self::afficherErreur("champ vide");
            }
        }
    }

    public static function creerDepuisFormulaire(): void
    {
        if ($_GET['mdp'] == $_GET['mdp2']) {
            $estAdmin = 0;
            if (ConnexionUtilisateur::estConnecte() && ConnexionUtilisateur::estAdministrateur()) {
                $estAdmin = isset($_GET['estAdmin']) ? 1 : 0;
            }
            $mdp = MotDePasse::hacher($_GET['mdp']);
            $modUtilisateur = Utilisateur::construireDepuisFormulaire(array($_GET['login'], $_GET['nom'], $_GET['prenom'],$mdp, $estAdmin, $_GET['email']));

            $sauv = (new UtilisateurRepository())->sauvegarder($modUtilisateur);
            if($sauv) {
                VerificationEmail::envoiEmailValidation($modUtilisateur);
            }
            if ($estAdmin == 1) {
                $modUtilisateur->setEstAdmin(true);
            } else {
                $modUtilisateur->setEstAdmin(false);
            }
            $utilisateurs = (new UtilisateurRepository())->recuperer();
            ControleurUtilisateur::afficherVue('vueGenerale.php', ['utilisateurs' => $utilisateurs, "pagetitle" => "Utilisateur créé", "cheminVueBody" => 'utilisateur/utilisateurCree.php']);
        } else {
            self::afficherErreur("mdp erreur");
        }
    }


        public static function validerEmail(): void
        {
            $login = $_GET['login'] ?? null;
            $nonce = $_GET['nonce'] ?? null;
            if ($login && $nonce) {
                $resultat =  VerificationEmail::traiterEmailValidation($login, $nonce);
                if ($resultat) {
                    self::afficherDetail();
                } else {
                    self::afficherErreur("Erreur de validation de l'email");
                }
            } else {
                self::afficherErreur("Paramètres manquants pour la validation de l'email");
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
            if ($utiVerif) {
                if (MotDePasse::verifier($_GET['mdp'], $utiVerif->getMdpHache())) {
                    ConnexionUtilisateur::connecter($_GET['login']);
                    ControleurUtilisateur::afficherVue('vueGenerale.php', ["pagetitle" => "Connecté", "cheminVueBody" => 'utilisateur/utilisateurConnecte.php', 'utilisateur' => $utiVerif]);
                } else {
                    self::afficherErreur("Login inconnu");
                }
            } else {
                self::afficherErreur("existe pas");
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