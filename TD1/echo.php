<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title> Mon premier php </title>
</head>

<body>
Liste des voitures :
<br>
<?php
/*$prenom = "Marc";
Exo 4
echo "Bonjour\n " . $prenom;
echo "Bonjour\n $prenom";
echo 'Bonjour\n $prenom';

echo $prenom;
echo "$prenom";

Exo 5.1

$marque = "Scenic";
$couleur = "bleu";
$immatriculation = "AZ-663-34";
$nbSieges = 4;

echo "Voiture $immatriculation de marque $marque (Couleur $couleur, $nbSieges sièges)";

Exo 5.2
*/
$voiture = [
        'marque' => 'Dacia',
    'couleur' => 'rouge',
    'immatriculation' => 'ZA-938-03',
    'nbSieges' => 5
];


foreach ($voiture as $cle => $valeur){
    echo $cle ." : ".$valeur;
    echo "<br>";
}

//echo "Voiture $voiture[immatriculation] de marque $voiture[marque] (Couleur $voiture[couleur], $voiture[nbSieges] sièges)";

//var_dump($voiture);

//Exo 5.4
$voiture2 = [
    'marque' => 'BMW',
    'couleur' => 'noir',
    'immatriculation' => 'ED-558-33',
    'nbSieges' => 5
];

$voiture3 = [
    'marque' => 'Renault',
    'couleur' => 'blanc',
    'immatriculation' => 'YV-908-19',
    'nbSieges' => 5
];

$voitures = [
        1 => $voiture,
    2 => $voiture2,
    3 => $voiture3
];

//var_dump($voitures);

if(empty($voitures))
    echo "Il n’y a aucune voiture.";
else
    foreach ($voitures as $cle => $valeur){
        foreach ($valeur as $cle2 => $valeur2)
        echo "<ul><li> $valeur2 </ul></li>";
    }


?>
</body>
</html>