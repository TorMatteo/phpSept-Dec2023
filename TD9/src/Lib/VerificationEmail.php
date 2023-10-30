<?php

namespace App\Covoiturage\Lib;

use App\Covoiturage\Configuration\ConfigurationSite;
use App\Covoiturage\Modele\DataObject\Utilisateur;
use App\Covoiturage\Modele\Repository\UtilisateurRepository;

class VerificationEmail
{
    public static function envoiEmailValidation(Utilisateur $utilisateur): void
    {
        $loginURL = rawurlencode($utilisateur->getLogin());
        $nonceURL = rawurlencode($utilisateur->getNonce());
        $URLAbsolue = ConfigurationSite::getURLAbsolue();
        $lienValidationEmail = "$URLAbsolue?action=validerEmail&controleur=utilisateur&login=$loginURL&nonce=$nonceURL";
        $corpsEmail = "<a href=\"$lienValidationEmail\">Validation</a>";

        // Temporairement avant d'envoyer un vrai mail
        var_dump($corpsEmail);
    }

    public static function traiterEmailValidation($login, $nonce): bool
    {
        $utilisateur = (new UtilisateurRepository())->recupererParClePrimaire($login);
        if ($utilisateur) {
            if ($utilisateur->getNonce() == $nonce) {
                $utilisateur->setEmail($utilisateur->getEmailAValider());
                $utilisateur->setNonce("");
                (new UtilisateurRepository())->mettreAJour($utilisateur);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function aValideEmail(Utilisateur $utilisateur): bool
    {
        if ($utilisateur->getEmail() != "") {
            return true;
        } else {
            return false;
        }
    }
}

?>