<!DOCTYPE html>
<html>
<head>

</head>
<body>
<form method="<?php echo \App\Covoiturage\Configuration\ConfigurationSite::getDebug() ? 'get' : 'post'; ?>">
    <fieldset>

        <legend>Pref :</legend>
        <input type="hidden" name="action" value="enregistrerPreference">
        <input type="radio" id="voitureId" name="controleur_defaut" value="voiture" <?php if(isset($_COOKIE['preferenceControleur']) && $_COOKIE['preferenceControleur'] == "voiture") echo "checked" ?>
        <label for="voitureId">Voiture</label>
        <input type="radio" id="utilisateurId" name="controleur_defaut" value="utilisateur" <?php if(isset($_COOKIE['preferenceControleur']) && $_COOKIE['preferenceControleur'] == "utilisateur") echo "checked"?>
        <label for="utilisateurId">Utilisateur</label>
        <input type="radio" id="trajetId" name="controleur_defaut" value="trajet" <?php if(isset($_COOKIE['preferenceControleur']) && $_COOKIE['preferenceControleur'] == "trajet") echo "checked" ?>
        <label for="trajetId">Trajet</label>


        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>

</body>
</html>