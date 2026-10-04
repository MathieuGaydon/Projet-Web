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
                    $this->sendConformationMail($email, $first_name, $last_name);
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

    private function sendConformationMail(string $email, string $first_name, string $last_name): bool {
        $to = $email;
        $subject = 'Confirmation de votre inscription - PFAS-Explorer';
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
            <title>Confirmation de votre inscription</title>
        </head>
        <body>
            <h2>Bonjour, ' . htmlspecialchars($last_name) . ' ' . htmlspecialchars($first_name) . '</h2>
            <p>
            Votre inscription sur PFAS-Explroer a bien été prise en compte</p>
            <p>Voici un récapitulatif de vos informations :</p>
            <ul>
                <li>Nom : ' .htmlspecialchars($last_name) . '</li>
                <li>Prénom : ' .htmlspecialchars($first_name) . '</li>
                <li>Email : ' .htmlspecialchars($email) . '</li>
            </ul>
            <p>Vous pouvez dès à présent vous connecter sur votre plateforme.</p>
            <br>
            <p>Cordialement, l\'équipe PFAS-Explorer</p>
        </body>
        </html>
        ';

        return mail($to, $subject, $message, $headers);
    }
}