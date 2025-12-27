<?php
namespace App\Core;

class Database
{
    private static $connection = null;

    public static function getConnection()
    {
        if (self::$connection === null) {
            $host = '127.0.0.1';
            $user = 'root';
            $pass = '';
            $db   = 'clinic_cli_oop';

            self::$connection = new \mysqli($host, $user, $pass, $db);

            if (self::$connection->connect_error) {
                die("Erreur de connexion MySQL: " . self::$connection->connect_error);
            }
        }

        return self::$connection;
    }
}
