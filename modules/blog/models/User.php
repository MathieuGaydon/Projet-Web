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

        $sql = 'INSERT INTO User (last_name, first_name, email, phone_number, password)
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
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM User WHERE email = :email');
        $stmt->execute(['email' => $email]);
        return (bool) $stmt->fetchColumn(); // récupère la valeur de la requête SQL et renvoie true ou false en fonction
    }
    public function findByEmail(string $email): ?object {
        $stmt = $this->db->prepare(
            'SELECT id_user, first_name, last_name, email, password FROM User WHERE email = :email LIMIT 1'
        );
        $stmt-> execute(['email' => $email]);
        $user = $stmt->fetch();
        return $user ?: null;
    }
}