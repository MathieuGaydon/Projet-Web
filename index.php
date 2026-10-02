<?php
require_once '_assets/includes/exceptions/autoloader.php';

try {
    // Vérifie la présence du paramètre "action" dans l'URL
    if (filter_input(INPUT_GET, 'action')) {
        $action = $_GET['action'];

        switch ($action) {
            case 'connexion':
                // Futur appel au contrôleur de connexion
                (new \Blog\Controllers\Auth\Login())->execute();
                break;

            case 'inscription':
                // Futur appel au contrôleur d'inscription
                // (new \Blog\Controllers\Auth\Register())->execute();
                echo "Page d'inscription (à implémenter)";
                break;

            case 'plan':
                (new \Blog\Controllers\Plan\Plan())->execute();
                break;

            case 'mdp-oublie':
                echo "Mot de passe oublié (à implémenter)";
                break;

            case 'legalnotice':
                (new \Blog\Controllers\Legalnotice\Legalnotice())->execute();
                break;

            default:
                throw new Exception("La page que vous recherchez n'existe pas.");
        }

    } else {
        // Redirection vers la page d'accueil par défaut
        (new \Blog\Controllers\Homepage\Homepage())->execute();
    }
} catch (Exception $e) {
    $title = "Erreur";
    $content = "<section class='error'><h1>Erreur</h1><p>" . htmlspecialchars($e->getMessage()) . "</p></section>";
    (new \Blog\Views\Layout($title, $content))->show();
}