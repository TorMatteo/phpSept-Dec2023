<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Liste des voitures</title>
</head>
<body>
<?php
foreach ($voitures as $voiture)
    echo '<p> Voiture d\'immatriculation <a href="https://webinfo.iutmontp.univ-montp2.fr/~tordeuxm/td-php/TD4/Controleur/routeur.php?action=afficherDetail&immatriculation='.$voiture->getImmatriculation().'">' . $voiture->getImmatriculation() .'</a>' . '.</p>';
?>
</body>
</html>
<?php
