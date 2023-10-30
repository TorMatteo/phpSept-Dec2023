<!DOCTYPE html>
<html>
<head>

</head>
<body>
<form method="<?php echo ConfigurationSite::getDebug() ? 'GET' : 'POST'; ?>">
    <fieldset>

        <legend>Creation :</legend>
        <p>
            <input type='hidden' name='controleur' value='utilisateur'>
            <input type='hidden' name='action' value='creerDepuisFormulaire'>
        </p>
        <p><label for="immat_id">Login</label>
            <input type="text" placeholder="l4" name="login" id="immat_id" required/>
        </p>
        <p>
            <label for="mar_id">Nom</label> :
            <input type="text" placeholder="Moulin" name="nom" id="mar_id" required/>
        </p>
        <p>
            <label for="coul_id">Prenom</label> :
            <input type="text" placeholder="Jean" name="prenom" id="coul_id" required>
        </p>
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="mdp_id">Mot de passe&#42;</label>
            <input class="InputAddOn-field" type="password" value="" placeholder="" name="mdp" id="mdp_id" required>
        </p>
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="mdp2_id">Vérification du mot de passe&#42;</label>
            <input class="InputAddOn-field" type="password" value="" placeholder="" name="mdp2" id="mdp2_id" required>
        </p>

        <?php  if(\App\Covoiturage\Lib\ConnexionUtilisateur::estConnecte() && \App\Covoiturage\Lib\ConnexionUtilisateur::estAdministrateur()){
        echo '<p class="InputAddOn">
            <label class="InputAddOn-item" for="estAdmin_id">Administrateur</label>
            <input class="InputAddOn-field" type="checkbox" placeholder="" name="estAdmin" id="estAdmin_id">
        </p>';}
        ?>
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="email_id">Email&#42;</label>
            <input class="InputAddOn-field" type="email" value="" placeholder="toto@yopmail.com" name="email" id="email_id" required>
        </p>
        <p>
            <input type="submit" value="Envoyer"/>
        </p>
    </fieldset>
</form>
</body>
</html>