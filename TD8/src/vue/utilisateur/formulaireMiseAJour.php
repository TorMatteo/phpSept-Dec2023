<!DOCTYPE html>
<html>
<head>

</head>
<body>
<form method="get">
    <fieldset>

        <legend>Mise à jour :</legend>
        <p>
            <input type='hidden' name='controleur' value='utilisateur'>
            <input type='hidden' name='action' value='mettreAJour'>
        </p>
        <p> <label for="immat_id">Login</label>
            <input type="text" value=<?php echo htmlspecialchars($utilisateur->getLogin()); ?> name="login" id="immat_id" readonly required>
        </p>
        <p>
            <label for="mar_id">Nom</label> :
            <input type="text" value= <?php echo  $utilisateur->getNom(); ?>  name="nom" id="mar_id" required>
        </p>
        <p>
            <label for="coul_id">Prenom</label> :
            <input type ="text" value= <?php echo  $utilisateur->getPrenom(); ?> name="prenom" id="coul_id" required>
        </p>
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="mdp3_id">Ancien mot de passe&#42;</label>
            <input class="InputAddOn-field" type="password" value="" placeholder="" name="mdp3" id="mdp3_id" required>
        </p>
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="mdp_id">Mot de passe&#42;</label>
            <input class="InputAddOn-field" type="password" value="" placeholder="" name="mdp" id="mdp_id" required>
        </p>
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="mdp2_id">Vérification du mot de passe&#42;</label>
            <input class="InputAddOn-field" type="password" value="" placeholder="" name="mdp2" id="mdp2_id" required>
        </p>
        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>

</body>
</html>