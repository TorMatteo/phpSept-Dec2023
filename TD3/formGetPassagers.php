<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title> Formulaire passagers </title>
</head>
<body>
<form method="get" action="testGetPassagers.php">
    <fieldset>
        <legend>Mon formulaire :</legend>
        <p>
            <label for="identification_id">id</label> :
            <input type="number" placeholder="1" name="id" id="identification_id" required/>
        </p>
        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>
</body>
</html>