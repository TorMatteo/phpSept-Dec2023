<?php
namespace App\Covoiturage\Modele\DataObject;



use App\Covoiturage\Lib\MotDePasse;

Class Utilisateur  extends AbstractDataObject {
    private string $login;
    private string $nom;
    private string $prenom;
    private string $mdpHache;
    private bool $estAdmin;
    private string $email;
    private string $emailAValider;
    private string $nonce;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEmailAValider(): string
    {
        return $this->emailAValider;
    }

    public function setEmailAValider(string $emailAValider): void
    {
        $this->emailAValider = $emailAValider;
    }

    public function getNonce(): string
    {
        return $this->nonce;
    }

    public function setNonce(string $nonce): void
    {
        $this->nonce = $nonce;
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
    public function __construct(string $login, string $nom, string $prenom, string $mdpHache, bool $estAdmin, string $email, string $emailAValider,  string $nonce)
    {
        $this->login = $login;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mdpHache = $mdpHache;
        $this->estAdmin = $estAdmin;
        $this->email = $email;
        $this->emailAValider = $emailAValider;
        $this->nonce = $nonce;
    }

     public static function construireDepuisFormulaire (array $tableauFormulaire) : Utilisateur{
        if($tableauFormulaire[4] == 1) {
            $admin = true;
        }
        else{
            $admin = false;
        }
        return new Utilisateur($tableauFormulaire[0], $tableauFormulaire [1], $tableauFormulaire[2],$tableauFormulaire[3], $admin, "", $tableauFormulaire[5], MotDePasse::genererChaineAleatoire());
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
    public function getEstAdmin(): bool
    {
        return $this->estAdmin;
    }

    public function setEstAdmin(bool $estAdmin): void
    {
        $this->estAdmin = $estAdmin;
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
            "estAdminTag" => $boolean,
            "emailTag" => $this->email,
            "emailAValiderTag" => $this->emailAValider,
            "nonceTag" => $this->nonce
        );
    }
}

?>