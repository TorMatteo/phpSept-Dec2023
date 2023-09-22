<?php
require_once 'ControleurVoiture.php';
// On recupère l'action passée dans l'URL
$action = $_GET['action'];
// Appel de la méthode statique $action de ControleurVoiture
ControleurVoiture::$action();
?>

