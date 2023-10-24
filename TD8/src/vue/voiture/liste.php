<!DOCTYPE html>
<html>
<body>
<?php
foreach ($voitures as $voiture){
    //$immatriculationHTML = $voiture->getImmatriculation();
    echo '<p> Voiture d\'immatriculation 
    <a href="https://webinfo.iutmontp.univ-montp2.fr/~tordeuxm/td-php/TD8/web/controleurFrontal.php?controleur=voiture&action=afficherDetail&immatriculation='
        .rawurlencode($voiture->getImmatriculation()).'">' . htmlspecialchars($voiture->getImmatriculation()) .'</a>'.' '.
    '<a href="https://webinfo.iutmontp.univ-montp2.fr/~tordeuxm/td-php/TD8/web/controleurFrontal.php?controleur=voiture&action=supprimer&immatriculation='
        .rawurlencode($voiture->getImmatriculation()).'"> suppr </a>'. ' '.
     '<a href="https://webinfo.iutmontp.univ-montp2.fr/~tordeuxm/td-php/TD8/web/controleurFrontal.php?controleur=voiture&action=afficherFormulaireMiseAJour&immatriculation='
        .rawurlencode($voiture->getImmatriculation()).'"> MAJ </a>'.  '</p>'; }
echo '<p> <a href="https://webinfo.iutmontp.univ-montp2.fr/~tordeuxm/td-php/TD8/web/controleurFrontal.php?controleur=voiture&action=afficherFormulaireCreation"> Creer voiture </a></p>'
?>
</body>
</html>

