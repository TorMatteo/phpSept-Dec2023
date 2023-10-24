<?php
namespace App\Covoiturage\Lib;
use App\Covoiturage\Modele\HTTP\Cookie;
class PreferenceControleur {
    private static string $clePreference = "preferenceControleur";

    public static function enregistrer(string $preference) : void
    {
        Cookie::enregistrer(PreferenceControleur::$clePreference, $preference);
    }

    public static function lire() : string
    {
        // À compléter
        return Cookie::lire(self::$clePreference);
    }

    public static function existe() : bool
    {
        return Cookie::contient(self::$clePreference);
    }

    public static function supprimer() : void
    {
        // À compléter
        Cookie::supprimer(self::$clePreference);
    }
}

?>