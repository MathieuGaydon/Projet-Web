<?php
namespace blog\models;

use PDO;
use function DDTrace\consume_distributed_tracing_headers;

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

    // gestion profil utlisateur
    // récupère les informations
    public function findById(int $id): ?object {
        $sql = 'SELECT id_user, first_name, last_name, email, phone_number, created_at FROM User WHERE id_user = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch();

        return $user ?: null;
    }

    // gestion profil utlisateur
    // vérifie le mot de passe
    public function verifyPassword(int $id, string $password): bool {
        $sql = 'SELECT password FROM User WHERE id_user = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch();

        return $user && password_verify($password, $user->password);
    }

    // gestion profil utlisateur
    // supprime le compte
    public function delete(int $id): bool {
        $sql = 'DELETE FROM User WHERE id_user = :id';
        $stmt = $this->db->prepare($sql);

        return $stmt->execute(['id' => $id]);
    }
}