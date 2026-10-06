<?php
namespace blog\controllers;

use blog\views\VerifyToken as VerifyTokenView;
use blog\models\Token;
use PDO;

class VerifyToken {
    private const MAX_ATTEMPTS = 5;
    private const RESET_WINDOW_SECONDS = 600; // 10 minutes

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function execute(): void {
        // Si on a pas demander un code on ne peux pas accéder à cette page
        if(empty($_SESSION['reset_user_id']) || empty($_SESSION['reset_email'])) {
            header('Location: index.php?action=mot_de_passe_oublie');
            exit();
        }

        if(empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        $id_user = $_SESSION['reset_user_id'];
        $email = $_SESSION['reset_email'];
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $code = trim($_POST['token'] ?? '');
            $csrf = $_POST['csrf_token'] ?? '';
            $tokenModel = new Token($this->pdo);

            if(($_SESSION['reset_attempts'] ?? 0) >= self::MAX_ATTEMPTS) {
                $tokenModel->deleteForUser((int) $id_user);
                unset($_SESSION['reset_user_id'], $_SESSION['reset_email'], $_SESSION['reset_attempts']);
                header('Location: index.php?action=mot_de_passe_oublie');
                exit();
            }

            if(!hash_equals($_SESSION['csrf_token'], $csrf)) {
                $errors[] ='Session expirée, veuillez réessayer.';
            } elseif ($code === '') {
                $errors[] = 'Veuillez saisir le code reçu par email.';
            } elseif ($tokenModel->isValid((int) $id_user, $code)) {
                $tokenModel->deleteForUser((int) $id_user);
                unset($_SESSION['reset_user_id'], $_SESSION['reset_email'], $_SESSION['reset_attempts']);
                $_SESSION['reset_verified_user'] = (int) $id_user;
                $_SESSION['reset_verified_until'] = time() + self::RESET_WINDOW_SECONDS;
                header('Location: index.php?action=reinitialisation_mdp');
                exit();
            } else {
                $_SESSION['reset_attempts'] = ($_SESSION['reset_attempts'] ?? 0) + 1;
                $errors[] = 'Le code est invalide ou expiré.';
            }
        }
        (new VerifyTokenView())->show($errors, $email, $_SESSION['csrf_token']);
    }
}