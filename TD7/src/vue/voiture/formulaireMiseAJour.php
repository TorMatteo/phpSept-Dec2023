<!DOCTYPE html>
<html>
<head>

</head>
<body>
<form method="get">
    <fieldset>

        <legend>Mise à jour :</legend>
        <p>
            <input type='hidden' name='action' value='mettreAJour'>
        </p>
        <p> <label for="immat_id">Immatriculation</label>
            <input type="text" value=<?php echo htmlspecialchars($voiture->getImmatriculation()); ?> name="immatriculation" id="immat_id" readonly required>
        </p>
        <p>
            <label for="mar_id">Marque</label> :
            <input type="text" value= <?php echo  $voiture->getMarque(); ?>  name="marque" id="mar_id" required>
        </p>
        <p>
            <label for="coul_id">Couleur</label> :
            <input type ="text" value= <?php echo  $voiture->getCouleur(); ?> name="couleur" id="coul_id" required>
        </p>
        <p>
            <label for="sie_id">nbSieges</label> :
            <input type="number" value= <?php echo  $voiture->getNbSieges(); ?> name="nbsieges" id="sie_id" required>
        </p>
        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>

</body>
</html>