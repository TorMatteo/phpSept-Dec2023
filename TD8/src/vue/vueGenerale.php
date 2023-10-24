<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $pagetitle; ?></title>
    <link rel="stylesheet" type="text/css" href="../ressources/css/td.css">
</head>
<body>
<header>
    <nav>
        <ul>
            <li>
                <a href="controleurFrontal.php?action=afficherListe&controleur=voiture">Gestion des voitures</a>
            </li><li>
                <a href="controleurFrontal.php?action=afficherListe&controleur=utilisateur">Gestion des utilisateurs</a>
            </li><li>
                <a href="controleurFrontal.php?action=afficherListe&controleur=trajet">Gestion des trajets</a>
            </li>
            <li>
                <a href="controleurFrontal.php?action=afficherFormulairePreference"><img src="../ressources/img/heart.png" alt="coeur"> </a>
            </li>
        </ul>
    </nav>
</header>
<main>
    <?php
    require __DIR__ . "/{$cheminVueBody}";
    ?>
</main>
<footer>
    <p>
        Site de covoiturage de ...
    </p>
</footer>
</body>
</html>

