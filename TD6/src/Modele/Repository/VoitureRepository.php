<?php
namespace App\Covoiturage\Modele\Repository;
use App\Covoiturage\Modele\DataObject\Voiture as Voiture;
Class VoitureRepository{

    public static function getVoitures() : array {
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->query('SELECT * FROM voiture');
        $listeVoiture = [];
        foreach ($pdoStatement as $voitureFormatTableau){
            $listeVoiture[] = self::construireDepuisTableau($voitureFormatTableau);
        }
        return$listeVoiture;
    }

    public static function getVoitureParImmat(string $immatriculation) : ?Voiture {
        $sql = "SELECT * from voiture WHERE immatriculation = :immatriculationTag";
        // Préparation de la requête
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "immatriculationTag" => $immatriculation,
            //nomdutag => valeur, ...
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);

        // On récupère les résultats comme précédemment
        // Note: fetch() renvoie false si pas de voiture correspondante
        $voitureFormatTableau = $pdoStatement->fetch();

        if($voitureFormatTableau == false) return null;

        return VoitureRepository::construireDepuisTableau($voitureFormatTableau);
    }

    public static function sauvegarder(Voiture $voiture) : bool {
        $sql = "INSERT INTO voiture (immatriculation, marque, couleur, nbSieges) VALUES (:immatriculationTag, :marqueTag, :couleurTag, :nbSiegesTag)";
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);
        $values = array(
            "immatriculationTag" => $voiture->getImmatriculation(),
            "marqueTag" => $voiture->getMarque(),
            "couleurTag" => $voiture->getCouleur(),
            "nbSiegesTag" => $voiture->getNbSieges()
        );
        $pdoStatement->execute($values);
        return true;

    }

    public static function construireDepuisTableau(array $voitureFormatTableau) : Voiture {
        return new Voiture($voitureFormatTableau[0], $voitureFormatTableau[1], $voitureFormatTableau[2], $voitureFormatTableau[3]);
    }

    public static function supprimerParImmatriculation(string $immatriculation){
        $sql = "DELETE FROM voiture WHERE immatriculation = :immatriculationTag";
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);
        $values = array(
            "immatriculationTag" => $immatriculation
        );
        $pdoStatement->execute($values);

    }
}

?>