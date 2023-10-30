<?php
namespace App\Covoiturage\Configuration;
 class ConfigurationSite{
     public static function getURLAbsolue(): string
     {
         return "http://webinfo.iutmontp.univ-montp2.fr/~tordeuxm/td-php/TD8/web/controleurFrontal.php";
     }

     public static function getDebug() : bool{
         return false;
     }
 }