<?php
require_once __DIR__ . '/_assets/includes/exceptions/Autoloader.php';

try {
    // Vérifie la présence du paramètre "action" dans l'URL
    if (filter_input(INPUT_GET, 'action')) {
        $action = $_GET['action'];

        switch ($action) {
            case 'connexion':
                // Futur appel au contrôleur de connexion
                // (new \Blog\Controllers\Auth\Login())->execute();
                echo "Page de connexion (à implémenter)";
                break;

            case 'inscription':
                // Futur appel au contrôleur d'inscription
                // (new \Blog\Controllers\Auth\Register())->execute();
                echo "Page d'inscription (à implémenter)";
                break;
                
            case 'mdp-oublie':
                (new \blog\controllers\mdpoublie\MdpOublie())->execute();
                break;


            default:
                throw new Exception("La page que vous recherchez n'existe pas.");
        }

    } else {
        // Redirection vers la page d'accueil par défaut
        (new \blog\controllers\homepage\Homepage())->execute();
    }
} catch (Exception $e) {
    $title = "Erreur";
    $content = "<section class='error'><h1>Erreur</h1><p>" . htmlspecialchars($e->getMessage()) . "</p></section>";
    (new \blog\views\Layout($title, $content))->show();
}