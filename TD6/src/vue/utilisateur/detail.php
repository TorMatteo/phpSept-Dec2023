<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php

echo '<p> login de l utilisateur : ' . htmlspecialchars($utilisateur->getLogin()) . '<br> nom Utilisateur : ' .
    $utilisateur->getNom() . '<br> nom de l utilisateur : ' . $utilisateur->getPrenom();
?>
</body>
</html>
<?php