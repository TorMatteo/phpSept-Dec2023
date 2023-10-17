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
        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>

</body>
</html>