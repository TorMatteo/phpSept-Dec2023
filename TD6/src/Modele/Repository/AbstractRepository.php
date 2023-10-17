<?php
namespace App\Covoiturage\Modele\Repository;
use App\Covoiturage\Modele\DataObject\AbstractDataObject;
use App\Covoiturage\Modele\DataObject\Voiture;

abstract class AbstractRepository{

    public function sauvegarder(AbstractDataObject $object): bool
    {
        $sql = "INSERT INTO ".$this->getNomTable()." ( ";
        $colonnes = $this->getNomsColonnes();
        $setClause = [];
        foreach ($colonnes as $colonne) {
            $setClause[] = "$colonne";
        }
        $sql .= implode(", ", $setClause);
        $sql .= ") VALUES (";
        $setClause2 = [];
        foreach ($colonnes as $colonne){
            $setClause2[] = ":{$colonne}Tag";
    }
        $sql .= implode(", ", $setClause2);
        $sql .= ")";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);
        $values= $object->formatTableau();
        $pdoStatement->execute($values);
        return true;
    }

    public function mettreAJour(AbstractDataObject $object): void
    {
        $sql = "UPDATE ".$this->getNomTable()." SET ";
        $colonnes = $this->getNomsColonnes();
        $setClause = [];
        foreach ($colonnes as $colonne) {
            $setClause[] = "$colonne = :{$colonne}Tag";
        }
        $sql .= implode(", ", $setClause);
        $sql .= " WHERE " . $this->getNomClePrimaire() . " = :".$this->getNomClePrimaire()."Tag";
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);
        $values = $object->formatTableau();
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