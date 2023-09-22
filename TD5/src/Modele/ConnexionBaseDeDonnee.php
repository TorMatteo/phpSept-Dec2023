<?php
require_once '../Configuration/Configuration.php';
class ConnexionBaseDeDonnee{
    private static ?ConnexionBaseDeDonnee $instance = null;
    private PDO $pdo;

    private function __construct(){
        $hostname = Configuration::getHostname();
        $port = Configuration::getPort();
        $databaseName = Configuration::getDatabase();
        $login = Configuration::getLogin();
        $password = Configuration::getPassword();
        $this->pdo= new PDO("mysql:host=$hostname;port=$port;dbname=$databaseName",$login,$password,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getPdo(): PDO {
        return ConnexionBaseDeDonnee::getInstance()->pdo;
    }

    private static function getInstance() : ConnexionBaseDeDonnee {
        // L'attribut statique $pdo s'obtient avec la syntaxe Model::$pdo
        // au lieu de $this->pdo pour un attribut non statique
        if (is_null(ConnexionBaseDeDonnee::$instance))
            // Appel du constructeur
            ConnexionBaseDeDonnee::$instance = new ConnexionBaseDeDonnee();
        return ConnexionBaseDeDonnee::$instance;
    }
}

?>