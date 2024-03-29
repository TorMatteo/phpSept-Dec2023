<?php
namespace App\Covoiturage\Modele\Repository;
use App\Covoiturage\Modele\DataObject\AbstractDataObject;
use App\Covoiturage\Modele\DataObject\Voiture as Voiture;

Class VoitureRepository extends AbstractRepository {
    public function getNomClePrimaire(): string
    {
        return "immatriculation";
    }

    public function getNomTable(): string{
        return "voiture";
    }

  /*  public static function getVoitureParImmat(string $immatriculation) : ?Voiture {
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
    }*/

    protected function construireDepuisTableau(array $voitureFormatTableau) : Voiture {
        return new Voiture($voitureFormatTableau[0], $voitureFormatTableau[1], $voitureFormatTableau[2], $voitureFormatTableau[3]);
    }

    protected function getNomsColonnes(): array
    {
        return ["immatriculation", "marque", "couleur", "nbSieges"];
    }

}

?>