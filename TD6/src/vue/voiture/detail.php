<!DOCTYPE html>
<html>
<head>

</head>
<body>
<?php

    echo '<p> Immatriculation de la voiture : ' . htmlspecialchars($voiture->getImmatriculation()) . '<br> Marque de la voiture : ' .
        $voiture->getMarque() . '<br> Couleur de la voiture : ' . $voiture->getCouleur() .
        '<br> Nombre de sièges : '. $voiture->getNbSieges(). '</p>';
?>
</body>
</html>
<?php