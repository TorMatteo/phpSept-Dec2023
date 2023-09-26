<?php

namespace App\Covoiturage\Controleur;
use App\Covoiturage\Modele\ModeleVoiture as ModeleVoiture;

class ControleurVoiture {

    private static function afficherVue(string $cheminVue, array $parametres = []) : void {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require __DIR__ . "/../vue/$cheminVue"; // Charge la vue
    }


    // Déclaration de type de retour void : la fonction ne retourne pas de valeur
    public static function afficherListe() : void {
        $voitures = ModeleVoiture::getVoitures(); //appel au modèle pour gerer la BD
        //ControleurVoiture::afficherVue('voiture/liste.php', ['voitures'=>$voitures]);  //"redirige" vers la vue
        ControleurVoiture::afficherVue('vueGenerale.php', ['voitures'=>$voitures, "pagetitle" => "Liste des voitures", "cheminVueBody" => "voiture/liste.php"]);
    }

    public static function afficherDetail() : void{
        if(ModeleVoiture::getVoitureParImmat($_GET['immatriculation']) != null){
            $voiture = ModeleVoiture::getVoitureParImmat($_GET['immatriculation']);
            ControleurVoiture::afficherVue('vueGenerale.php', ['voiture'=>$voiture, "pagetitle" => "Détails voiture", "cheminVueBody" => "voiture/detail.php"]);
        }
        else{
            ControleurVoiture::afficherVue('voiture/erreur.php');
        }
    }

    public static function afficherFormulaireCreation() : void{
        ControleurVoiture::afficherVue('vueGenerale.php' , ["pagetitle" => "Formulaire création voiture" ,"cheminVueBody" => 'voiture/formulaireCreation.php']);
    }

    public static function creerDepuisFormulaire() : void{
            $modVoiture = new ModeleVoiture($_GET['immatriculation'], $_GET['marque'], $_GET['couleur'], $_GET['nbsieges']);
            $modVoiture->sauvegarder();
            self::afficherListe();
        }

}

?>