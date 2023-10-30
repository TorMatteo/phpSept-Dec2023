<!DOCTYPE html>
<html>
<head>

</head>
<body>
<form method="<?php echo ConfigurationSite::getDebug() ? 'GET' : 'POST'; ?>">
    <fieldset>

        <legend>Pref :</legend>
        <input type="hidden" name="action" value="enregistrerPreference">
        <input type="radio" id="voitureId" name="controleur_defaut" value="voiture" <?php if($_COOKIE['preferenceControleur'] == "voiture") echo "checked" ?>
        <label for="voitureId">Voiture</label>
        <input type="radio" id="utilisateurId" name="controleur_defaut" value="utilisateur" <?php if($_COOKIE['preferenceControleur'] == "utilisateur") echo "checked"?>
        <label for="utilisateurId">Utilisateur</label>
        <input type="radio" id="trajetId" name="controleur_defaut" value="trajet" <?php if($_COOKIE['preferenceControleur'] == "trajet") echo "checked" ?>
        <label for="trajetId">Trajet</label>


        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>

</body>
</html>