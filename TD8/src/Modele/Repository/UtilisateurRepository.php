<?php
namespace App\Covoiturage\Modele\Repository;

use App\Covoiturage\Modele\DataObject\Utilisateur as Utilisateur;
Class UtilisateurRepository extends AbstractRepository {
    public function getNomClePrimaire(): string
    {
        return "login";
    }

    public function getNomTable(): string{
        return "utilisateur";
    }
    /*public static function getUtilisateurs() : array {
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->query('SELECT * FROM utilisateur');
        $listeUtilisateur = [];
        foreach ($pdoStatement as $utilisateurFormatTableau){
            $listeUtilisateur[] = self::construireDepuisTableau($utilisateurFormatTableau);
        }
        return $listeUtilisateur;
    }*/

    protected function construireDepuisTableau(array $utilisateurFormatTableau) : Utilisateur {
        return new Utilisateur($utilisateurFormatTableau[0], $utilisateurFormatTableau[1], $utilisateurFormatTableau[2], $utilisateurFormatTableau[3], $utilisateurFormatTableau[4],
        $utilisateurFormatTableau[5], $utilisateurFormatTableau[6], $utilisateurFormatTableau[7]);
    }
    protected function getNomsColonnes(): array
    {
        return ["login", "nom", "prenom", "mdpHache", "estAdmin", "email", "emailAValider", "nonce"];
    }


}
?>