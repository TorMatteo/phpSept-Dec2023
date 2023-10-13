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

 protected function construireDepuisTableau(array $voitureFormatTableau) : Voiture {
        return new Voiture($voitureFormatTableau[0], $voitureFormatTableau[1], $voitureFormatTableau[2], $voitureFormatTableau[3]);
    }

    public static function mettreAJour(Voiture $voiture) : void{
        $sql = "UPDATE voiture SET marque = :marqueTag, couleur = :couleurTag, nbSieges = :nbSiegesTag WHERE 
                immatriculation = :immatriculationTag";
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);
        $values = array(
            "marqueTag" => $voiture->getMarque(),
            "couleurTag" => $voiture->getCouleur(),
            "nbSiegesTag" => $voiture->getNbSieges(),
            "immatriculationTag" => $voiture->getImmatriculation()
        );
        $pdoStatement->execute($values);
    }
}

?>