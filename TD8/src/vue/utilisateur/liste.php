<!DOCTYPE html>
<html>
<body
<?php
foreach ($utilisateurs as $utilisateur){
    echo '<p>  
<a href="https://webinfo.iutmontp.univ-montp2.fr/~tordeuxm/td-php/TD8/web/controleurFrontal.php?controleur=utilisateur&action=afficherDetail&login='.
        rawurlencode($utilisateur->getLogin()) .'">'. htmlspecialchars($utilisateur->getLogin()). '</a>
<a href="https://webinfo.iutmontp.univ-montp2.fr/~tordeuxm/td-php/TD8/web/controleurFrontal.php?controleur=utilisateur&action=supprimer&login='
        .rawurlencode($utilisateur->getLogin()).'"> suppr  </a>
<a href="https://webinfo.iutmontp.univ-montp2.fr/~tordeuxm/td-php/TD8/web/controleurFrontal.php?controleur=utilisateur&action=afficherFormulaireMiseAJour&login='
    .rawurlencode($utilisateur->getLogin()).'"> MAJ </a></p>';
    echo '<p> <a href="https://webinfo.iutmontp.univ-montp2.fr/~tordeuxm/td-php/TD8/web/controleurFrontal.php?controleur=utilisateur&action=afficherFormulaireCreation"> Creer utilisateur </a></p>';


}
?>
</body>
</html>
