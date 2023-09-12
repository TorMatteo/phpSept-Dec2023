<?php
require_once ("Voiture.php");
require_once ("Model.php");

//echo Voiture::getVoitureParImmat("3213EA33");

$voitureTD3 = new Voiture("KE756TF", "Ford", "Blanc", 4);
$voitureTD3->sauvegarder();
?>