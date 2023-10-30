<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
use App\Covoiturage\Lib\ConnexionUtilisateur;
echo '<p> login de l utilisateur : ' . htmlspecialchars($utilisateur->getLogin()) . '<br> nom Utilisateur : ' .
    $utilisateur->getNom() . '<br> nom de l utilisateur : ' . $utilisateur->getPrenom();
if (ConnexionUtilisateur::estConnecte() && ($utilisateur->getLogin() == ConnexionUtilisateur::getLoginUtilisateurConnecte() || ConnexionUtilisateur::estAdministrateur()))
echo '<p> <a href="https://webinfo.iutmontp.univ-montp2.fr/~tordeuxm/td-php/TD8/web/controleurFrontal.php?controleur=utilisateur&action=afficherFormulaireMiseAJour&login='
    .rawurlencode($utilisateur->getLogin()).'"> MAJ </a> | 
<a href="https://webinfo.iutmontp.univ-montp2.fr/~tordeuxm/td-php/TD8/web/controleurFrontal.php?controleur=utilisateur&action=supprimer&login='
        .rawurlencode($utilisateur->getLogin()).'">suppr  </a></p>';

?>
</body>
</html>
<?php