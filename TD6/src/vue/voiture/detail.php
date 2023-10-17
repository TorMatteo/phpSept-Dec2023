<!DOCTYPE html>
<html>
<head>

</head>
<body>
<?php

    echo '<p> Immatriculation de la voiture : ' . htmlspecialchars($voiture->getImmatriculation()) . '<br> Marque de la voiture : ' .
        $voiture->getMarque() . '<br> Couleur de la voiture : ' . $voiture->getCouleur() .
        '<br> Nombre de sièges : '. $voiture->getNbSieges(). '</p>';
    echo '<p><a href="https://webinfo.iutmontp.univ-montp2.fr/~tordeuxm/td-php/TD6/web/controleurFrontal.php?action=afficherFormulaireMiseAJour&immatriculation='
        .rawurlencode($voiture->getImmatriculation()).'"> MAJ </a></p>';
?>
</body>
</html>
<?php