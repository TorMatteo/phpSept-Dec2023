<?php

namespace App\Covoiturage\Controleur;

use App\Covoiturage\Modele\Repository\AbstractRepository;
use App\Covoiturage\Modele\Repository\VoitureRepository as VoitureRepository;
use App\Covoiturage\Modele\DataObject\Voiture as Voiture;

class ControleurVoiture {

    private static function afficherVue(string $cheminVue, array $parametres = []) : void {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require __DIR__ . "/../vue/$cheminVue"; // Charge la vue
    }


    // Déclaration de type de retour void : la fonction ne retourne pas de valeur
    public static function afficherListe() : void {
        $voitures = (new VoitureRepository())->recuperer(); //appel au modèle pour gerer la BD
        //ControleurVoiture::afficherVue('voiture/liste.php', ['voitures'=>$voitures]);  //"redirige" vers la vue
        ControleurVoiture::afficherVue('vueGenerale.php', ['voitures'=>$voitures, "pagetitle" => "Liste des voitures", "cheminVueBody" => "voiture/liste.php"]);
    }

    public static function afficherDetail() : void{
        $voiture = (new VoitureRepository())->recupererParClePrimaire($_GET['immatriculation']);
        ControleurVoiture::afficherVue('vueGenerale.php', ['voiture'=>$voiture, "pagetitle" => "Détails voiture", "cheminVueBody" => "voiture/detail.php"]);

    }

    public static function afficherFormulaireCreation() : void{
        ControleurVoiture::afficherVue('vueGenerale.php' , ["pagetitle" => "Formulaire création voiture" ,"cheminVueBody" => 'voiture/formulaireCreation.php']);
    }

    public static function creerDepuisFormulaire() : void{
            $modVoiture = new Voiture($_GET['immatriculation'], $_GET['marque'], $_GET['couleur'], $_GET['nbsieges']);
            $accepter = (new VoitureRepository())->sauvegarder($modVoiture);
            $voitures = (new VoitureRepository())->recuperer();
            ControleurVoiture::afficherVue('vueGenerale.php' ,['voitures' => $voitures ,"pagetitle"=>"Voiture créée", "cheminVueBody" => 'voiture/voitureCreee.php']);
        }

    public static function afficherErreur(string $messageErreur = ""){
        ControleurVoiture::afficherVue('voiture/erreur.php');
    }

    public static function supprimer() : void {
        $immatriculation = $_GET['immatriculation'];
        (new VoitureRepository())->supprimer($immatriculation);
        $voitures = (new VoitureRepository())->recuperer();
        ControleurVoiture::afficherVue('vueGenerale.php' ,
            ['voitures' => $voitures, 'immatriculation' => $immatriculation ,"pagetitle"=>"Voiture suppr", "cheminVueBody" => 'voiture/voitureSupprimee.php']);
    }

    public static function afficherFormulaireMiseAJour() : void{
        $immatriculation = $_GET['immatriculation'];
        $voiture = (new VoitureRepository())->recupererParClePrimaire($immatriculation);
        ControleurVoiture::afficherVue('vueGenerale.php', ['voiture' => $voiture, "pagetitle"=>"MAJ",
            "cheminVueBody" => 'voiture/formulaireMiseAJour.php']);
    }

    public static function mettreAJour() : void {
        $modVoiture = new Voiture($_GET['immatriculation'], $_GET['marque'], $_GET['couleur'], $_GET['nbsieges']);
        (new VoitureRepository())->mettreAJour($modVoiture);
        $voitures = (new VoitureRepository())->recuperer();
        ControleurVoiture::afficherVue('vueGenerale.php', ['voitures' => $voitures, "pagetitle" => "Voiture modifiée", "cheminVueBody"=> 'voiture/voitureMiseAJour.php', 'immatriculation' => $modVoiture->getImmatriculation()]);
    }

}

?>