<?php
namespace App\Covoiturage\Lib;

use App\Covoiturage\Modele\HTTP\Session;

class MessageFlash
{

    // Les messages sont enregistrés en session associée à la clé suivante
    private static string $cleFlash = "_messagesFlash";

    // $type parmi "success", "info", "warning" ou "danger"
    public static function ajouter(string $type, string $message): void
    {

        $session = Session::getInstance();
        $messages = $session->contient(self::$cleFlash) ? $session->lire(self::$cleFlash) : [];
        $messages[$type][] = $message;
        $session->enregistrer(self::$cleFlash, $messages);

    }

    public static function contientMessage(string $type): bool
    {
        $session = Session::getInstance();
        if ($session->contient(self::$cleFlash)) {
            $array = $session->lire(self::$cleFlash);
            return isset($array[$type]);
        }
        return false;

    }

    // Attention : la lecture doit détruire le message
    public static function lireMessages(string $type): array
    {
        $session = Session::getInstance();
        $messages = $session->contient(self::$cleFlash) ? $session->lire(self::$cleFlash) : [];
        $result = isset($messages[$type]) ? $messages[$type] : [];
        unset($messages[$type]);
        $session->enregistrer(self::$cleFlash, $messages);
        return $result;
    }

    public static function lireTousMessages() : array
    {
        $session = Session::getInstance();
        $messages = $session->contient(self::$cleFlash) ? $session->lire(self::$cleFlash) : [];
        $session->supprimer(self::$cleFlash);
        return $messages;
    }

}
?>