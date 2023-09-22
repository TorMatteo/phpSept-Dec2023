<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Détails d'une voiture</title>
</head>
<body>
<?php

    echo '<p> Immatriculation de la voiture : ' . $voiture->getImmatriculation() . '<br> Marque de la voiture : ' .
        $voiture->getMarque() . '<br> Couleur de la voiture : ' . $voiture->getCouleur() .
        '<br> Nombre de sièges : '. $voiture->getNbSieges(). '</p>';
?>
</body>
</html>
<?php