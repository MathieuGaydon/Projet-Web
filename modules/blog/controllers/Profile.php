<?php

namespace blog\controllers;

use blog\models\User;
use PDO;

class Profile {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function execute(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // redirection si non connecté
        if (empty($_SESSION['user_id'])) {
            header('Location: index.php?action=connexion');
            exit();
        }

        $userModel = new User($this->pdo);
        $userId = (int) $_SESSION['user_id'];
        $user = $userModel->findById($userId);

        if (!$user) {
            session_destroy();
            header('Location: index.php?action=connexion');
            exit();
        }

        $errors = [];

        // suppression du compte
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_account'])) {
            $password = $_POST['password'] ?? '';

            if (empty($password)) {
                $errors[] = 'Veuillez entrer votre mot de passe pour poursuivre votre action';
            } elseif (!$userModel->verifyPassword($userId, $password)) {
                $errors[] = 'Mot de passe est incorrect';
            } else {
                // si mot de passe correct alros supprime le compte
                if ($userModel->delete($userId)) {
                    session_destroy();
                    header('Location: index.php?action=inscription&message=deleted');
                    exit();
                } else {
                    $errors[] = 'Erreur lors de la suppression';
                }
            }
        }

        (new \blog\views\Profile())->show($user, $errors);
    }
}