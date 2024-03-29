<?php
namespace App\Covoiturage\Controleur;
use App\Covoiturage\Lib\PreferenceControleur;
class ControleurGenerique{

     protected static function afficherVue(string $cheminVue, array $parametres = []) : void {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require __DIR__ . "/../vue/$cheminVue"; // Charge la vue
    }

    public static function afficherFormulairePreference(){
         self::afficherVue('vueGenerale.php', ["pagetitle"=>"pref", "cheminVueBody"=>"formulairePreference.php"]);
    }

    public static function enregistrerPreference(){
        (new PreferenceControleur())->enregistrer($_REQUEST['controleur_defaut']);
        self::afficherVue('vueGenerale.php', ["pagetitle"=>"pref", "cheminVueBody"=>"preferenceEnregistree.php"]);
    }
}

?>