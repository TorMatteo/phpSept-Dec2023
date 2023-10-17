<!DOCTYPE html>
<html>
<body>
<?php
foreach ($voitures as $voiture)
    //$immatriculationHTML = $voiture->getImmatriculation();
    echo '<p> Voiture d\'immatriculation 
    <a href="https://webinfo.iutmontp.univ-montp2.fr/~tordeuxm/td-php/TD7/web/controleurFrontal.php?action=afficherDetail&immatriculation='
        .rawurlencode($voiture->getImmatriculation()).'">' . htmlspecialchars($voiture->getImmatriculation()) .'</a>'.' '.
    '<a href="https://webinfo.iutmontp.univ-montp2.fr/~tordeuxm/td-php/TD7/web/controleurFrontal.php?action=supprimer&immatriculation='
        .rawurlencode($voiture->getImmatriculation()).'"> suppr </a>'. ' '.
     '<a href="https://webinfo.iutmontp.univ-montp2.fr/~tordeuxm/td-php/TD7/web/controleurFrontal.php?action=afficherFormulaireMiseAJour&immatriculation='
        .rawurlencode($voiture->getImmatriculation()).'"> MAJ </a>'.  '</p>';
echo '<p> <a href="https://webinfo.iutmontp.univ-montp2.fr/~tordeuxm/td-php/TD7/web/controleurFrontal.php?action=afficherFormulaireCreation"> Creer voiture </a></p>'
?>
</body>
</html>

