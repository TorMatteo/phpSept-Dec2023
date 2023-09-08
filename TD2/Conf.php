<?php
class Conf {

    static private array $databaseConfiguration = array(
        // Le nom d'hote est webinfo a l'IUT
        // ou localhost sur votre machine
        //
        // ou webinfo.iutmontp.univ-montp2.fr
        // pour accéder à webinfo depuis l'extérieur
        'hostname' => 'webinfo.iutmontp.univ-montp2.fr',
        // A l'IUT, vous avez une BDD nommee comme votre login
        // Sur votre machine, vous devrez creer une BDD
        'database' => 'tordeuxm',
        // À l'IUT, le port de MySQL est particulier : 3316
        // Ailleurs, on utilise le port par défaut : 3306
        'port' => '3306',
        // A l'IUT, c'est votre login
        // Sur votre machine, vous avez surement un compte 'root'
        'login' => 'tordeuxm',
        // A l'IUT, c'est le même mdp que PhpMyAdmin
        // Sur votre machine personelle, vous avez creez ce mdp a l'installation
        'password' => '08022003'
    );

    static public function getLogin() : string {
        // L'attribut statique $databaseConfiguration
        // s'obtient avec la syntaxe Conf::$databaseConfiguration
        // au lieu de $this->databaseConfiguration pour un attribut non statique
        return Conf::$databaseConfiguration['login'];
    }

    static public function getHostname() : string {
        return Conf::$databaseConfiguration['hostname'];
    }

    static public function getPort() : string {
        return Conf::$databaseConfiguration['port'];
    }

    static public function getDatabase() : string {
        return Conf::$databaseConfiguration['database'];
    }

    static public function getPassword() : string {
        return Conf::$databaseConfiguration['password'];
    }

}
?>