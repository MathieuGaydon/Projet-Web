<?php
namespace blog\models;

use PDO;

class Token {
    private PDO $db;

    public function __construct(PDO $pdo){
        $this->db = $pdo;
    }

    //Génère un code de 8 caractères
    public static function generate(): string {
        return strtoupper(bin2hex(random_bytes(4)));
    }

    //on stock le code hasher
    private static function hash(string $token): string {
        $normalized = strtoupper(preg_replace('/\s+/', '', $token));
        return hash('sha256', $normalized);
    }

    public function createForUser(int $id_user, string $token, int $minutes = 15): bool {
        $this->deleteExpired();
        $this->deleteForUser($id_user);

        $minutes = max(1, $minutes);
        $stmt = $this->db->prepare(
            "INSERT INTO Token (token, expires_at, id_user) VALUES (:token, Date_ADD(NOW(), INTERVAL $minutes MINUTE), :id_user)"
        );

        return $stmt->execute([
            'token' => self::hash($token),
            'id_user' => $id_user
        ]);
    }

    //le code existe et appartient a cet utilisateur et n'est pas expiré
    public function isValid(int $id_user, string $token): bool {
        $stmt = $this ->db->prepare(
            'SELECT 1 FROM Token WHERE id_user = :id_user AND token = :token AND expires_at > NOW()'
        );
        $stmt->execute([
            'id_user' => $id_user,
            'token' => self::hash($token)
        ]);
        return (bool) $stmt->fetchColumn();
    }

    public function deleteForUser(int $id_user): bool {
        $stmt = $this->db->prepare('DELETE FROM Token WHERE id_user = :id_user');
        return $stmt->execute(['id_user' => $id_user]);
    }

    //supprime les tokens expirés
    public function deleteExpired(): int {
        $stmt = $this->db->prepare('DELETE FROM Token WHERE expires_at <= NOW()');
        $stmt->execute();
        return $stmt->rowCount();
    }
}