<?php
namespace App\Covoiturage\Controleur;
use App\Covoiturage\Lib\MessageFlash;
use App\Covoiturage\Lib\PreferenceControleur;
class ControleurGenerique{

     protected static function afficherVue(string $cheminVue, array $parametres = []) : void {
        extract($parametres); // Crée des variables à partir du tableau $parametres
         $messagesFlash = MessageFlash::lireTousMessages();
        require __DIR__ . "/../vue/$cheminVue"; // Charge la vue
    }

    public static function afficherFormulairePreference(){
         self::afficherVue('vueGenerale.php', ["pagetitle"=>"pref", "cheminVueBody"=>"formulairePreference.php"]);
    }

    public static function enregistrerPreference(){
        MessageFlash::ajouter("success", "La préférence de contrôleur est enregistrée !");
         (new PreferenceControleur())->enregistrer($_REQUEST['controleur_defaut']);
        self::redirectionVersURL("https://webinfo.iutmontp.univ-montp2.fr/~tordeuxm/td-php/TD9/web/controleurFrontal.php");
    }
    public static function redirectionVersURL(string $url): void
    {
        header("Location: $url");
        exit();
    }
}

?>