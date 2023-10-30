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
        $utilisateur = (new UtilisateurRepository())->recupererParClePrimaire($_REQUEST['login']);
        ControleurUtilisateur::afficherVue('vueGenerale.php', ['utilisateur' => $utilisateur, "pagetitle" => "Details utilisateur", "cheminVueBody" => "utilisateur/detail.php"]);
    }

    public static function supprimer(): void
    {

        /*$login = $_REQUEST['login'];
        (new UtilisateurRepository())->supprimer($login);
        $utilisateurs = (new UtilisateurRepository())->recuperer();
        ControleurUtilisateur::afficherVue('vueGenerale.php',
            ['utilisateurs' => $utilisateurs, 'login' => $login, "pagetitle" => "Uti suppr", "cheminVueBody" => 'utilisateur/utilisateurSupprimee.php']);*/
        $utiVerif = (new UtilisateurRepository())->recupererParClePrimaire($_REQUEST['login']);
        if ($utiVerif) {
            if ($utiVerif->getLogin() == Session::getInstance()->lire('_utilisateurConnecte') || ConnexionUtilisateur::estAdministrateur()) {
                (new UtilisateurRepository())->supprimer($_REQUEST['login']);
                $utilisateurs = (new UtilisateurRepository())->recuperer();
                ControleurUtilisateur::afficherVue('vueGenerale.php',
                    ['utilisateurs' => $utilisateurs, 'login' => $_REQUEST['login'], "pagetitle" => "Uti suppr", "cheminVueBody" => 'utilisateur/utilisateurSupprimee.php']);
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

        $login = $_REQUEST['login'];
        $utilisateur = (new UtilisateurRepository())->recupererParClePrimaire($login);
        if ($utilisateur) {
            if ($_REQUEST['login'] == ConnexionUtilisateur::getLoginUtilisateurConnecte() || ConnexionUtilisateur::estAdministrateur()) {
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
            $uti = (new UtilisateurRepository())->recupererParClePrimaire($_REQUEST['login']);
            if ($uti) {
                $estAdmin = isset($_REQUEST['estAdmin']) ? 1 : 0;
                var_dump($estAdmin);
                $utilisateur = Utilisateur::construireDepuisFormulaire(array($_REQUEST['login'], $_REQUEST['nom'], $_REQUEST['prenom'], $uti->getMdpHache(), $estAdmin));
                (new UtilisateurRepository())->mettreAJour($utilisateur);
                if ($estAdmin == 1) {
                    $utilisateur->setEstAdmin(true);
                } else {
                    $utilisateur->setEstAdmin(false);
                }
                $utilisateurs = (new UtilisateurRepository())->recuperer();
                ControleurUtilisateur::afficherVue('vueGenerale.php', ['utilisateurs' => $utilisateurs, "pagetitle" => "Utilisateur modifié", "cheminVueBody" => 'utilisateur/utilisateurMiseAJour.php', 'login' => $utilisateur->getLogin()]);
            } else {
                self::afficherErreur("login existe pas");
            }
        } else {
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                if ((!empty($_POST['nom']) || !empty($_REQUEST['prenom']) || !empty($_REQUEST['mdp']) || !empty($_REQUEST['mdp2']) || !empty($_REQUEST['mdp3']))) {
                    $utiVerif = (new UtilisateurRepository())->recupererParClePrimaire($_REQUEST['login']);
                    if ($utiVerif) {
                        if ($utiVerif->getLogin() == Session::getInstance()->lire('_utilisateurConnecte')) {
                            if (MotDePasse::verifier($_REQUEST['mdp3'], $utiVerif->getMdpHache())) {
                                if ($_REQUEST['mdp'] == $_REQUEST['mdp2']) {
                                    $mdp = MotDePasse::hacher($_REQUEST['mdp']);
                                    $estAdmin = isset($_REQUEST['estAdmin']) ? 1 : 0;
                                    $utilisateur = Utilisateur::construireDepuisFormulaire(array($_REQUEST['login'], $_REQUEST['nom'], $_REQUEST['prenom'], $mdp, $estAdmin, $_REQUEST['email']));
                                    (new UtilisateurRepository())->mettreAJour($utilisateur);
                                    VerificationEmail::envoiEmailValidation($utilisateur);
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
            } else {
                self::afficherErreur("erreur email");
            }
        }
    }

    public static function creerDepuisFormulaire(): void
    {
        if (filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)) {
            if ($_REQUEST['mdp'] == $_REQUEST['mdp2']) {
                $estAdmin = 0;
                if (ConnexionUtilisateur::estConnecte() && ConnexionUtilisateur::estAdministrateur()) {
                    $estAdmin = isset($_REQUEST['estAdmin']) ? 1 : 0;
                }
                $mdp = MotDePasse::hacher($_REQUEST['mdp']);
                $modUtilisateur = Utilisateur::construireDepuisFormulaire(array($_REQUEST['login'], $_REQUEST['nom'], $_REQUEST['prenom'], $mdp, $estAdmin, $_REQUEST['email']));

                $sauv = (new UtilisateurRepository())->sauvegarder($modUtilisateur);
                if ($sauv) {
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
        } else {
            self::afficherErreur("email incorrecte");
        }
    }


    public static function validerEmail(): void
    {
        $login = $_REQUEST['login'] ?? null;
        $nonce = $_REQUEST['nonce'] ?? null;
        if ($login && $nonce) {
            $resultat = VerificationEmail::traiterEmailValidation($login, $nonce);
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
        if (isset($_REQUEST['login']) || isset($_REQUEST['mdp'])) {
            $utiVerif = (new UtilisateurRepository())->recupererParClePrimaire($_REQUEST['login']);
            if ($utiVerif) {
                if (MotDePasse::verifier($_REQUEST['mdp'], $utiVerif->getMdpHache())) {
                    if (VerificationEmail::aValideEmail($utiVerif)) {
                        ConnexionUtilisateur::connecter($_REQUEST['login']);
                        ControleurUtilisateur::afficherVue('vueGenerale.php', ["pagetitle" => "Connecté", "cheminVueBody" => 'utilisateur/utilisateurConnecte.php', 'utilisateur' => $utiVerif]);
                    } else {
                        self::afficherErreur("email pas validé");
                    }
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