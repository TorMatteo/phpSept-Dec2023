<!DOCTYPE html>
<html>
<body>
<?php
foreach ($voitures as $voiture)
    //$immatriculationHTML = $voiture->getImmatriculation();
    echo '<p> Voiture d\'immatriculation 
    <a href="https://webinfo.iutmontp.univ-montp2.fr/~tordeuxm/td-php/TD5/web/controleurFrontal.php?action=afficherDetail&immatriculation='
        .rawurlencode($voiture->getImmatriculation()).'">' . htmlspecialchars($voiture->getImmatriculation()) .'</a>' . '.</p>';
?>
</body>
</html>
<?php
