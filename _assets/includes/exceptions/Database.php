<?php

namespace includes\exceptions;

use PDO;
use PDOException;

class Database {
    private static ?PDO $instance = null;

    public static function getInstance(): PDO {
        if (self::$instance === null) {
            try {
                $host = 'mysql-pfas-explorer.alwaysdata.net';
                $dbname = 'pfas-explorer_database';
                $user = 'pfas-explorer';
                $password = 'NevotVousEtesUnGoat2.40';

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