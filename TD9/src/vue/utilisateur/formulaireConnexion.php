<!DOCTYPE html>
<html>
<head>

</head>
<body>
<form method="<?php echo ConfigurationSite::getDebug() ? 'GET' : 'POST'; ?>">
    <fieldset>
        <legend>Connexion :</legend>
         <p><label for="immat_id">Login</label>
            <input type="text" placeholder="l4" name="login" id="immat_id" required/>
        </p>
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="mdp_id">Mot de passe&#42;</label>
            <input class="InputAddOn-field" type="password" value="" placeholder="" name="mdp" id="mdp_id" required>
        </p>
        <p>
            <input type='hidden' name='controleur' value='utilisateur'>
            <input type='hidden' name='action' value='connecter'>
            <input type="submit" value="Envoyer">
        </p>
    </fieldset>
</form>
</body>
</html>