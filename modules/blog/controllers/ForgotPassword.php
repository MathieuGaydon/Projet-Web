<?php
namespace blog\controllers;

use blog\views\ForgotPassword as ForgotPasswordView;
use blog\models\User;
use blog\models\Token;
use PDO;

class ForgotPassword {
    private const TOKEN_LIFETIME_MINUTES = 15;
    private PDO $pdo;
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function execute(): void {
        if(empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        $errors = [];
        $email = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $csrf = $_POST['csrf_token'] ?? '';

            if(!hash_equals($_SESSION['csrf_token'], $csrf)) {
                $errors[] ='Session expirée, veuillez réessayer.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors[] = 'L\'adresse email n\'est pas valide.';
            } else {
                $user = (new User($this->pdo))->findByEmail($email);
                if ($user === null) {
                    $errors[] = 'Aucun compte n\'est associé à cette adresse email.';
                } else {
                    $tokenModel = new Token($this->pdo);
                    $code = Token::generate();
                    $tokenModel->createForUser((int) $user->id_user, $code, self::TOKEN_LIFETIME_MINUTES);

                    if ($this-> sendResetMail($user->email, $user->first_name, $code)){
                        // On mémorise qui a demandé un code
                        $_SESSION['reset_user_id'] = (int) $user->id_user;
                        $_SESSION['reset_email'] = $user->email;
                        $_SESSION['reset_attempts'] = 0;
                        header('Location: index.php?action=verification_token');
                        exit();
                    }
                    $tokenModel->deleteForUser((int) $user->id_user);
                    $errors[] = 'Impossible d\'envoyer l\'email pour le moment, veuillez réessayer.';
                }
            }
        }
        (new ForgotPasswordView())->show($errors, $email, $_SESSION['csrf_token']);
    }

    private function sendResetMail(string $email, string $first_name, string $code): bool {
        $to = $email;
        $subject = 'Réinitialisation de votre mot de passe - PFAS-Explorer';
        $from = 'no-reply@pfas-explorer.alwaysdata.net';

        // en-tête
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From: PFAS-Explorer <" . $from . ">\r\n";
        $headers .= "Reply-To: " . $from . "\r\n";

        // contenu
        $message = '
        <!DOCTYPE html>
        <html lang="fr">
        <head>
        <meta charset="UTF-8">
            <title>Réinitialisation de votre mot de passe</title>
        </head>
        <body>
            <h2>Bonjour, ' . htmlspecialchars($first_name) . '</h2>
            <p>Vous avez demandé la réinitialisation de votre mot de passe sur PFAS-Explorer.</p>
            <p>voici votre code de vérification :</p>
            <p style="font-size: 24px; font-weight: bold; letter-spacing: 4px;">' . htmlspecialchars($code) . '</p>
            <p> Ce code est valide pendant ' . self::TOKEN_LIFETIME_MINUTES . ' minutes.</p>
            <p>Si vous n\'êtes pas à l\'origine de cette demande, ignorez simplement cet email.</p>
            <br>
            <p>Cordialement, l\'équipe PFAS-Explorer</p>
        </body>
        </html>
        ';
        return mail($to, $subject, $message, $headers);
    }
}