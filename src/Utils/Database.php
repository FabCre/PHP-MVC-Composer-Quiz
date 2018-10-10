<?php

namespace Oquiz\Utils;

use PDO;
use Exception;
use Oquiz\App;

// Design Pattern : Singleton
class Database
{
    /** @var PDO */
    private $dbh;
    private static $_instance;

    private function __construct()
    {
        // PHP "parse" = de lire le fichier de config
        $config = parse_ini_file(__DIR__ . '/../config.conf');
        try {
            $this->dbh = new PDO(
              "mysql:host={$config['DB_HOST']};dbname={$config['DB_NAME']};charset=utf8",
              $config['DB_USER'],
              $config['DB_PASSWORD'],
              array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING) // Affiche les erreurs SQL à l'écran
          );
        } catch (Exception $exception) {
            die('Erreur de connexion...'.$exception->getMessage());
        }
    }

    // La méthode unique à appeler
    public static function getPDO()
    {
        // Si il n'y a pas d'instance alors une est créé
        if (empty(self::$_instance)) {
            self::$_instance = new Database();
        }
        
        return self::$_instance->dbh;
    }
}
