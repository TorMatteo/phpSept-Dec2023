<?php
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
            '<br> Nombre de places : ' .$this->getNbSieges();
    }

}
?>

