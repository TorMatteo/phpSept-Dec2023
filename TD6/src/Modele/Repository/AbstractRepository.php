<?php
namespace App\Covoiturage\Modele\Repository;
use App\Covoiturage\Modele\DataObject\AbstractDataObject;
use App\Covoiturage\Modele\DataObject\Voiture;

abstract class AbstractRepository{

    public function mettreAJour(Voiture $voiture): void
    {
        $sql = "UPDATE ".$this->getNomTable()." SET ";
        $colonnes = $this->getNomsColonnes();
        $setClause = [];
        foreach ($colonnes as $colonne) {
            $setClause[] = "$colonne = :{$colonne}Tag";
        }
        $sql .= implode(", ", $setClause);
        $sql .= " WHERE " . $this->getNomClePrimaire() . " = :immatriculationTag";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);
        $values = array(
            "marqueTag" => $voiture->getMarque(),
            "couleurTag" => $voiture->getCouleur(),
            "nbSiegesTag" => $voiture->getNbSieges(),
            "immatriculationTag" => $voiture->getImmatriculation()
        );
        $pdoStatement->execute($values);
    }

    public function recuperer(): array
    {
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->query('SELECT * FROM '.$this->getNomTable());
        $listeRep = [];
        foreach ($pdoStatement as $repFormatTableau) {
            $listeRep[] = $this->construireDepuisTableau($repFormatTableau);
        }
        return $listeRep;
    }

    protected abstract function getNomTable(): string;
    protected abstract function getNomsColonnes(): array;

    protected abstract function construireDepuisTableau(array $objetFormatTableau) : AbstractDataObject;

    public function recupererParClePrimaire(string $valeurClePrimaire): ?AbstractDataObject{
        $sql = "SELECT * from ".$this->getNomTable()." WHERE ".  $this->getNomClePrimaire(). "= :Tag";
        // Préparation de la requête
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "Tag" => $valeurClePrimaire,
            //nomdutag => valeur, ...
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);

        // On récupère les résultats comme précédemment
        // Note: fetch() renvoie false si pas de voiture correspondante
        $objFormatTableau = $pdoStatement->fetch();

        if($objFormatTableau == false) return null;

        return $this->construireDepuisTableau($objFormatTableau);

    }
    protected abstract function getNomClePrimaire(): string;
    public function supprimer(string $clefPrim)
    {
        $sql = "DELETE FROM ".$this->getNomTable()." WHERE ".$this->getNomClePrimaire()." =:Tag";
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);
        $values = array(
            "Tag" => $clefPrim
        );
        $pdoStatement->execute($values);
    }
}
?>