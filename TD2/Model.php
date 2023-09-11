<?php
require_once 'Conf.php';
class Model{
    private static ?Model $instance = null;
    private PDO $pdo;

    private function __construct(){
        $hostname = Conf::getHostname();
        $port = Conf::getPort();
        $databaseName = Conf::getDatabase();
        $login = Conf::getLogin();
        $password = Conf::getPassword();
        $this->pdo= new PDO("mysql:host=$hostname;port=$port;dbname=$databaseName",$login,$password,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getPdo(): PDO {
        return Model::getInstance()->pdo;
    }

    private static function getInstance() : Model {
        // L'attribut statique $pdo s'obtient avec la syntaxe Model::$pdo
        // au lieu de $this->pdo pour un attribut non statique
        if (is_null(Model::$instance))
            // Appel du constructeur
            Model::$instance = new Model();
        return Model::$instance;
    }
}

?>