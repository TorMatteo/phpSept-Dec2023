<?php
namespace App\Covoiturage\Modele\Repository;

use App\Covoiturage\Modele\DataObject\Utilisateur as Utilisateur;
Class UtilisateurRepository extends AbstractRepository {
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
        return new Utilisateur($utilisateurFormatTableau[0], $utilisateurFormatTableau[1], $utilisateurFormatTableau[2]);
    }

}
?>