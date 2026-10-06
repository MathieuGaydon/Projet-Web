<?php
namespace blog\controllers;

use blog\views\Login as LoginView;
use blog\models\User;
use PDO;

class Login{
private PDO $pdo;

public function __construct(PDO $pdo) {
    $this->pdo = $pdo;
}

public function execute(): void {
    if(isset($_SESSION['user'])) {
        header('Location: index.php?action=homepage');
        exit();
    }

    if(empty($_SESSION['csrf_token'])){
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    $errors = [];
    $email = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $csrf = $_POST['csrf_token'] ?? '';
            $userModel = new User($this->pdo);
            $user = $userModel ->findByEmail($email);

            if($user === null || !password_verify($password, $user->password)) {
                $errors[] = 'Email ou mot de passe incorrect.';
            }else {
                if (password_needs_rehash($user->password, PASSWORD_DEFAULT)){
                    $userModel->updatePassword((int) $user->id_user, $password);
                }

                session_regenerate_id(true);

                $_SESSION['user'] =[
                'id' => (int) $user->id_user,
                'first_name' => $user-> first_name,
                'last_name' => $user-> last_name,
                'email' => $user-> email,
                ];

                $_SESSION['user_id'] = (int) $user->id_user;

                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));


                header('Location: index.php?action=homepage');
                exit();
            }
        }
        (new LoginView())->show($errors, $email, $_SESSION['csrf_token']);
    }
}