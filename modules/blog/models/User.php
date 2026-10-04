<?php
namespace blog\models;

use PDO;

class User {
    private PDO $db;

    public function __construct(PDo $pdo) {
        $this->db = $pdo;
    }

    public function create(
        string $last_name,
        string $first_name,
        string $email,
        string $password,
        string $phone_number
        ): bool {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = 'INSERT INTO Users (last_name, first_name, email, phone_number, password)
        VALUES (:last_name, :first_name, :email, :phone_number, :password)';

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'last_name' => $last_name,
            'first_name' => $first_name,
            'email' => $email,
            'phone_number' => $phone_number,
            'password' => $hashed_password
        ]);
    }
    
    // On vérifie si l'email existe ou non
    public function emailExists(string $email): bool {
        $stmt = $this->db->prepare(SELECT COUNT(*) FROM Users WHERE email = :email);
        $stmt->execute(['email' => $email]);
        return (bool) $stmt->fetchColumn(); // récupère la valeur de la requête SQL et renvoie true ou false en fonction
    }
}