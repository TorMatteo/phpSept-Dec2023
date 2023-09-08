<?php
require_once 'Conf.php';
class Model{

    private PDO $pdo;

    public function __construct(){
        $hostname = Conf::getHostname();
        $port = Conf::getPort();
        $databaseName = Conf::getDatabase();
        $login = Conf::getLogin();
        $password = Conf::getPassword();
        $this->pdo= new PDO("mysql:host=$hostname;port=$port;dbname=$databaseName",$login,$password);
    }

    public function getPdo(){
        return $this->pdo;
    }

}

?>