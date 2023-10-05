<!DOCTYPE html>
<html>
<body
<?php
foreach ($utilisateurs as $utilisateur){
    echo '<p> '. htmlspecialchars($utilisateur->getLogin()) . '</p>';
}
?>
</body>
</html>
