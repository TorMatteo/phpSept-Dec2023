<?php

require_once ('../Modele/ModeleVoiture.php'); // chargement du modèle
class ControleurVoiture {

    private static function afficherVue(string $cheminVue, array $parametres = []) : void {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require "../vue/$cheminVue"; // Charge la vue
    }


    // Déclaration de type de retour void : la fonction ne retourne pas de valeur
    public static function afficherListe() : void {
        $voitures = ModeleVoiture::getVoitures(); //appel au modèle pour gerer la BD
        ControleurVoiture::afficherVue('voiture/liste.php', ['voitures'=>$voitures]);  //"redirige" vers la vue
    }

    public static function afficherDetail() : void{
        if(ModeleVoiture::getVoitureParImmat($_GET['immatriculation']) != null){
            $voiture = ModeleVoiture::getVoitureParImmat($_GET['immatriculation']);
            ControleurVoiture::afficherVue('voiture/detail.php', ['voiture'=>$voiture]);
        }
        else{
            ControleurVoiture::afficherVue('voiture/erreur.php');
        }
    }

    public static function afficherFormulaireCreation() : void{
        ControleurVoiture::afficherVue('voiture/formulaireCreation.php');
    }

    public static function creerDepuisFormulaire() : void{
       /* if(ModeleVoiture::getVoitureParImmat($_GET['immatriculation']) != null){
            $modVoiture = new ModeleVoiture($_GET['immatriculation'], $_GET['marque'], $_GET['couleur'], $_GET['nbsieges']);
            $modVoiture->sauvegarder();
            self::afficherDetail();
        }*/
        echo "bonjour";
    }
}

?>