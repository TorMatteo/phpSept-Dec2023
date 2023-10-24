<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php

echo '<p> login de l utilisateur : ' . htmlspecialchars($utilisateur->getLogin()) . '<br> nom Utilisateur : ' .
    $utilisateur->getNom() . '<br> nom de l utilisateur : ' . $utilisateur->getPrenom();
echo '<p> <a href="https://webinfo.iutmontp.univ-montp2.fr/~tordeuxm/td-php/TD8/web/controleurFrontal.php?controleur=utilisateur&action=afficherFormulaireMiseAJour&login='
    .rawurlencode($utilisateur->getLogin()).'"> MAJ </a></p>';
?>
</body>
</html>
<?php