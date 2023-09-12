<?php
require_once "Model.php";
class Voiture {


    private string $immatriculation;
    private string $marque;
    private string $couleur;
    private int $nbSieges; // Nombre de places assises

    // un getter
    public function getMarque() : string {
        return $this->marque;
    }

    // un setter
    public function setMarque(string $marque) {
        $this->marque = $marque;
    }

    public function getImmatriculation() : string
    {
        return $this->immatriculation;
    }

    public function setImmatriculation(string $immatriculation)
    {
        $immatriculation =  substr($immatriculation, 0, 8);
        $this->immatriculation = $immatriculation;
    }

    public function getCouleur() : string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur)
    {
        $this->couleur = $couleur;
    }

    public function getNbSieges() : int
    {
        return $this->nbSieges;
    }

    public function setNbSieges(int $nbSieges)
    {
        $this->nbSieges = $nbSieges;
    }

    public static function construireDepuisTableau(array $voitureFormatTableau) : Voiture {
        return new Voiture($voitureFormatTableau[0], $voitureFormatTableau[1], $voitureFormatTableau[2], $voitureFormatTableau[3]);
    }

    public static function getVoitures() {
        $pdoStatement = Model::getPdo()->query('SELECT * FROM voiture');
        $voitureFormatTableau = $pdoStatement->fetch();
        $listeVoiture = [];
        foreach ($pdoStatement as $voitureFormatTableau){
            $listeVoiture[] = self::construireDepuisTableau($voitureFormatTableau);
        }
        return$listeVoiture;
    }

    public static function getVoitureParImmat(string $immatriculation) : ?Voiture {
        $sql = "SELECT * from voiture WHERE immatriculation = :immatriculationTag";
        // Préparation de la requête
        $pdoStatement = Model::getPdo()->prepare($sql);

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

        return Voiture::construireDepuisTableau($voitureFormatTableau);
    }

    public function sauvegarder() : void {
        $sql = "INSERT INTO voiture (immatriculation, marque, couleur, nbSieges) VALUES (:immatriculationTag, :marqueTag, :couleurTag, :nbSiegesTag)";
        $pdoStatement = Model::getPdo()->prepare($sql);
        $values = array(
            "immatriculationTag" => $this->immatriculation,
            "marqueTag" => $this->marque,
            "couleurTag" => $this->couleur,
            "nbSiegesTag" => $this->nbSieges
        );
        $pdoStatement->execute($values);

    }


    // un constructeur
    public function __construct(
        string $immatriculation,
        string $marque,
        string $couleur,
        int $nbSieges
    ) {
        $this->immatriculation = substr($immatriculation, 0, 8);
        $this->marque = $marque;
        $this->couleur = $couleur;
        $this->nbSieges = $nbSieges;
    }

    // Pour pouvoir convertir un objet en chaîne de caractères
    public function __toString() : string {
        // À compléter dans le prochain exercice
        return 'Voiture marque : ' .$this->getMarque() .
            '<br> Couleur : ' .$this->getCouleur() .
            '<br> Immatriculation : ' .$this->getImmatriculation() .
            '<br> Nombre de places : ' .$this->getNbSieges() . '<br> <br>' ;
    }



}
?>

