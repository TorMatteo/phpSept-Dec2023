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
            <?php
            if(!\App\Covoiturage\Lib\ConnexionUtilisateur::estConnecte())
            echo '<li>
                <a href="controleurFrontal.php?action=afficherFormulaireCreation&controleur=utilisateur"><img src="../ressources/img/add-user" alt="add"></a>
            </li>
            <li>
                <a href="controleurFrontal.php?action=afficherFormulaireConnexion&controleur=utilisateur"><img src="../ressources/img/enter" alt="ent"></a>
            </li>';
            else
                echo '<li>
                <a href="controleurFrontal.php?action=afficherDetail&controleur=utilisateur&login='.\App\Covoiturage\Lib\ConnexionUtilisateur::getLoginUtilisateurConnecte().'"><img src="../ressources/img/user" alt="use"> </a>
                </li>
                <li>
                <a href="controleurFrontal.php?action=deconnecter&controleur=utilisateur"><img src="../ressources/img/logout" alt="out"></a>
                </li>';
            ?>
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

