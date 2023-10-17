<!DOCTYPE html>
<html>
  <head>

  </head>
  <body>
  <form method="get">
    <fieldset>
      <legend>Mon formulaire :</legend>
        <p>
        <input type='hidden' name='action' value='creerDepuisFormulaire'>
        </p>
        <p>
        <label for="immat_id">Immatriculation</label> :
        <input type="text" placeholder="256AB34" name="immatriculation" id="immat_id" required/>
      </p>
      <p>
        <label for="mar_id">Marque</label> :
        <input type="text" placeholder="Scenic" name="marque" id="mar_id" required/>
      </p>
      <p>
        <label for="coul_id">Couleur</label> :
        <input type ="text" placeholder="Bleu" name="couleur" id="coul_id" required/>
      </p>
      <p>
        <label for="sie_id">nbSieges</label> :
        <input type="number" placeholder="2" name="nbsieges" id="sie_id" required/>
      </p>
      <p>
        <input type="submit" value="Envoyer" />
      </p>
    </fieldset>
  </form>
  </body>
</html>