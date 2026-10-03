<?php
namespace blog\views;

class Layout {
    public function __construct(
        private string $title,
        private string $content
    ) {}

    public function show(): void {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?= htmlspecialchars($this->title) ?></title>
            <link rel="stylesheet" href="_assets/styles/style.css">
        </head>
        <body>
        <header>
            <nav>
                <a href="index.php">Accueil</a>
                <a href="index.php?action=inscription">Inscription</a>
                <a href="index.php?action=connexion">Connexion</a>
            </nav>
        </header>

        <main>
            <?= $this->content ?>
        </main>

        <footer>
            <p>&copy; <?= date('Y') ?> - Tous droits réservés</p>
        </footer>
        </body>
        </html>
        <?php
    }
}