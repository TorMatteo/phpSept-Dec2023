
<?php
require_once "Voiture.php";

echo 'Voiture : marque ' .$_POST['marque'] . '<br>plaque : ' . $_POST['immatriculation'] .
'<br>couleur : ' .$_POST['couleur'] . '<br>nombre de sièges : ' . $_POST['nbsieges'];

//$sauvVoiture = new Voiture($_POST['immatriculation'], $_POST['marque'], $_POST['couleur'], $_POST['nbsieges']);
//$sauvVoiture->sauvegarder();
?>