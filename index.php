<?php
session_start();
require_once __DIR__ . '/_assets/includes/exceptions/Autoloader.php';

try {
    // Vérifie la présence du paramètre "action" dans l'URL
    if (filter_input(INPUT_GET, 'action')) {
        $action = $_GET['action'];

        switch ($action) {
            case 'homepage':
                (new \blog\controllers\Homepage())->execute();
                break;

            case 'connexion':
                // Futur appel au contrôleur de connexion
                // (new \Blog\Controllers\Auth\Login())->execute();
                echo "Page de connexion (à implémenter)";
                break;

            case 'deconnexion':
                $_SESSION=[];
                session_destroy();
                header('Location: index.php?action=homepage');
                exit();

            case 'inscription':
                $pdo = \includes\exceptions\Database::getInstance();
                (new \blog\controllers\Register($pdo))->execute();
                break;

            default:
                throw new Exception("La page que vous recherchez n'existe pas.");
        }

    } else {
        // Redirection vers la page d'accueil par défaut
        (new \blog\controllers\Homepage())->execute();
    }
} catch (Exception $e) {
    $title = "Erreur";
    $content = "<section class='error'><h1>Erreur</h1><p>" . htmlspecialchars($e->getMessage()) . "</p></section>";
    (new \blog\views\Layout(title: 'Erreur',
        description: '',
        sm_title: '',
        sm_description: '',
        sm_image: '',
        sm_url: '',
        button_1: 'S\'inscrire',
        button_2: 'Connexion',
        content: $content,
        button_3: 'Déconnexion'))->show();
}