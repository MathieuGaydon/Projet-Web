<?php
namespace blog\controllers;

use blog\views\Register as RegisterView;
use blog\views\Layout;
use blog\models\User;
use PDO;

class Register {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function execute(): void
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // on récupère les données
            $last_name = trim($_POST['last_name'] ?? '');
            $first_name = trim($_POST['first_name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $password_verification = $_POST['password_verification'] ?? '';
            $phone_number = trim($_POST['phone_number'] ?? '');

            // vérification de la conformité des champs saisis
            if (empty($last_name)) {
                $errors[] = 'Le nom est obligatoire';
            }
            if (empty($first_name)) {
                $errors[] = 'Le prénom est obligatoire';
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // si le mail ne correspond pas au filtre
                $errors[] = 'L\'adresse email n\'est pas valide';
            }
            if (empty($password)) {
                $errors[] = 'Le mot de passe est obligatoire';
            }
            if ($password !== $password_verification) {
                $errors[] = 'Les mots de passe ne correspondent pas';
            }
            if (!isset($_POST['terms'])) {
                $errors[] = 'Vous devez accepter les conditions générales';
            }
            // (à ajouter) contrainte sur le numéro de téléphone
            // (à ajouter) contrainte de sécurité sur le mot de passe
            
            $userModel = new User($this->pdo);

            //On vérifie si l'email existe ou non
            if (empty($errors) && $userModel->emailExists($email)) {
                $errors[] = 'Cette adresse-mail est déjà utilisée.';
            }

            // gestion des données
            if (empty($errors)) {
                // on enregistre dans la BDD
                $saved = $userModel->create($last_name, $first_name, $email, $password, $phone_number);

                if ($saved) {
                    header('Location: index.php?page=login');
                    exit();
                } else {
                    // on envoie les erreurs à la vue
                    $errors[] = 'Une erreur est survenue lors de l\'enregistrement';
                }
            }
        }
        (new RegisterView())->show($errors);
    }
}