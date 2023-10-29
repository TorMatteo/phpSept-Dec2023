<?php
namespace App\Covoiturage\Modele\DataObject;



use App\Covoiturage\Lib\MotDePasse;

Class Utilisateur  extends AbstractDataObject {
    private string $login;
    private string $nom;
    private string $prenom;
    private string $mdpHache;
    private bool $estAdmin;

    public function isEstAdmin(): bool
    {
        return $this->estAdmin;
    }

    public function setEstAdmin(bool $estAdmin): void
    {
        $this->estAdmin = $estAdmin;
    }

    /**
     * @return string
     */
    public function getMdpHache(): string
    {
        return $this->mdpHache;
    }

    /**
     * @param string $mdpHache
     */
    public function setMdpHache(string $mdpHache): void
    {
        $this->mdpHache = $mdpHache;
    }

    /**
     * @param string $login
     * @param string $nom
     * @param string $prenom
     */
    public function __construct(string $login, string $nom, string $prenom, string $mdpHache, bool $estAdmin)
    {
        $this->login = $login;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mdpHache = $mdpHache;
        $this->estAdmin = $estAdmin;
    }

     public static function construireDepuisFormulaire (array $tableauFormulaire) : Utilisateur{
        $mdp = MotDePasse::hacher($tableauFormulaire[3]);

        return new Utilisateur($tableauFormulaire[0], $tableauFormulaire [1], $tableauFormulaire[2], $mdp, $tableauFormulaire[4]);
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    public function formatTableau(): array
    {
        if($this->estAdmin == true){
            $boolean = 1;
        }
        else {
            $boolean = 0;
        }
        return array(
            "loginTag" => $this->login,
            "nomTag" => $this->nom,
            "prenomTag" => $this->prenom,
            "mdpHacheTag" => $this->mdpHache,
            "estAdminTag" => $boolean
        );
    }
}

?>