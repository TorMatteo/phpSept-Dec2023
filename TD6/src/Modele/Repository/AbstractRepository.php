<?php
namespace App\Covoiturage\Modele\Repository;
abstract class AbstractRepository{
    public function recuperer(): array
    {
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->query('SELECT * FROM '.self::getNomTable());
        $listeVoiture = [];
        foreach ($pdoStatement as $voitureFormatTableau) {
            $listeVoiture[] = VoitureRepository::construireDepuisTableau($voitureFormatTableau);
        }
        return $listeVoiture;
    }

    protected abstract function getNomTable(): string;


}
?>