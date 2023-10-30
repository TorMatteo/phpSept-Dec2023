<?php
namespace App\Covoiturage\Modele\HTTP;

class Cookie{
    public static function enregistrer(string $cle, mixed $valeur, ?int $dureeExpiration = null): void {
        if($dureeExpiration == null){
            $temps = 0;
        }
        else{
            $temps = $dureeExpiration;
        }
        setcookie($cle, $valeur, $temps);

    }
    public static function lire(string $cle): mixed{
        if((new Cookie())->contient($cle) == true) return $_COOKIE[$cle];
        else return "cookie error";
    }

    public static function contient($cle) : bool{
        if (isset($_COOKIE[$cle])) return true;
        else return false;
    }

    public static function supprimer($cle) : void {
        unset($_COOKIE[$cle]);
        setcookie ($cle, "", 1);
    }






}

?>