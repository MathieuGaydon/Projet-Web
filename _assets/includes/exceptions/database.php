<?php
namespace Includes\Database;

use PDO;
use PDOException;

class Database {
    private static ?PDO $instance = null;

    public static function getInstance(): PDO {
        if (self::$instance === null) {
            try {
                $host = 'mysql-afu.alwaysdata.net';
                $dbname = 'afu_database';
                $user = 'afu';
                $password = '?';

                self::$instance = new PDO(
                    "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                    $user,
                    $password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                    ]
                );
            } catch (PDOException $e) {
                die('Erreur de connexion BDD : ' . $e->getMessage());
            }
        }
        return self::$instance;
    }
}