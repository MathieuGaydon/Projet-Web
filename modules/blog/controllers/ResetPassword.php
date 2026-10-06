<?php
namespace blog\controllers;

use blog\views\ResetPassword as ResetPasswordView;
use blog\models\User;
use PDO;

class ResetPassword {

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function execute(): void {
        $id_user = $_SESSION['reset_verified_user'] ?? null;
        $until = $_SESSION['reset_verified_until'] ?? 0;

        if ($id_user === null || time() > $until) {
            unset($_SESSION['reset_verified_user'], $_SESSION['reset_verified_until']);
            header('Location: index.php?action=mot_de_passe_oublie');
            exit();
        }

        if(empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = $_POST['password'] ?? '';
            $password_verification = $_POST['password_verification'] ?? '';
            $csrf = $_POST['csrf_token'] ?? '';

            if(!hash_equals($_SESSION['csrf_token'], $csrf)) {
                $errors[] ='Session expirée, veuillez réessayer.';
            } else {
                if ($password === ''){
                    $errors[] = 'Le mot de passe est obligatoire.';
                }
                if ($password !== $password_verification) {
                    $errors[] = 'Les mots de passe ne correspondent pas.';
                }
            }
            if(empty($errors)) {
                if((new User($this->pdo))->updatePassword((int) $id_user, $password)) {
                    unset($_SESSION['reset_verified_user'], $_SESSION['reset_verified_until']);
                    header('Location: index.php?action=connexion&reset_success=1');
                    exit();
                }
                $errors[] = 'Une erreur est survenue lors de la mise à jour du mot de passe.';
            }
        }
        (new ResetPasswordView())->show($errors, $_SESSION['csrf_token']);
    }
}