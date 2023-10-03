<?php
require_once __DIR__ . '/../src/Lib/Psr4AutoloaderClass.php';
// initialisation

$loader = new App\Covoiturage\Lib\Psr4AutoloaderClass();
$loader->register();
// enregistrement d'une association "espace de nom" → "dossier"
$loader->addNamespace('App\Covoiturage', __DIR__ . '/../src');

use App\Covoiturage\Controleur\ControleurVoiture as ControleurVoiture;


// On recupère l'action passée dans l'URL
if(isset($_GET['action'])){
    $action = $_GET['action'];
}
else {
    $action = "afficherListe";
}

$classCV =  get_class_methods(App\Covoiturage\Controleur\ControleurVoiture::class);
$verif = 0;
foreach ($classCV as $method){
    if($action == $method)($verif = 1);
}

// Appel de la méthode statique $action de ControleurVoiture
if($verif == 0){
    ControleurVoiture::afficherErreur();
}
else{
    ControleurVoiture::$action();
}
?>


