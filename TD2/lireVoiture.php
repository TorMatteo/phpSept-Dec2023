<?php
require_once("Model.php");
require_once("Voiture.php");

//$pdoStatement = Model::getPdo()->query('SELECT * FROM voiture');
//$voitureFormatTableau = $pdoStatement->fetch();

//var_dump($voitureFormatTableau);

//$voiture = new Voiture($voitureFormatTableau[0], $voitureFormatTableau[1], $voitureFormatTableau[2], $voitureFormatTableau[3]);

//echo '<br>' . $voiture;


//foreach($pdoStatement as $voitureFormatTableau){
    //var_dump($voitureFormatTableau);
   /* echo $voiture = new Voiture($voitureFormatTableau[0], $voitureFormatTableau[1], $voitureFormatTableau[2], $voitureFormatTableau[3]) . '<br>';
}*/



foreach (Voiture::getVoitures() as $voiture){
    echo $voiture;
}




?>