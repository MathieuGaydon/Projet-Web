<?php
namespace blog\views;

class Layout {
    public function __construct(
        private string $title,
        private string $description,
        private string $sm_title,
        private string $sm_description,
        private string $sm_image,
        private string $sm_url,
        private string $info_button_1,
        private string $button_1,
        private string $info_button_2,
        private string $button_2,
        private string $content,
        private string $button_3
    ) {}

    public function show(): void {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta name="description" content=<?=($this->description)?>>
                <title><?= htmlspecialchars($this->title) ?></title>
                <link rel="stylesheet" href="..\..\_assets\styles\style.css">
                <link rel="stylesheet" href="..\..\_assets\styles\register.css">
                <link rel="stylesheet" href="..\..\_assets\styles\login.css">
                <!--meta pour l'affichage réseaux sociaux-->
                <meta property="og:title" content="<?= htmlspecialchars($this->sm_title ?? '')?>">
                <meta property="og:description" content="<?= htmlspecialchars($this->sm_description ?? '')?>">
                <meta property="og:image" content="<?= htmlspecialchars($this->sm_image ?? '')?>">
                <meta property="og:url" content="<?= htmlspecialchars($this->sm_url ?? '')?>">
                <link rel="icon" href="../../favicon.ico" type="image/ico">
                <!--Import Font Inter, Noto Serif & Quicksand-->
                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
            </head>
            <body>
                <header class="header">
                    <h1><a href="index.php?action=homepage" class="btn-accueil">PFAS-EXPLORER</a></h1>
                    <!--Menu-->
                    <div id="buttonnav">
                            <?php if (!isset($_SESSION['user'])) : ?>
                                <a href="index.php?action=<?= htmlspecialchars($this->info_button_1 ?? '')?>" class="inside"><?=($this->button_1)?></a>
                                <a href="index.php?action=<?= htmlspecialchars($this->info_button_2 ?? '')?>" class="inside"><?=($this->button_2)?></a>
                            <?php else : ?>
                                <a href="index.php?action=deconnexion" class="inside"><?=($this->button_3)?></a>
                            <?php endif; ?>
                    </div>
                </header>

                <main>
                    <?= $this->content ?>
                </main>

                <footer>
                    <div class="footer-description">
                        <p>PFAS-EXPLORER</p>
                        <p>PFAS-Explorer est une application web cartographique permettant d'explorer les contaminations aux PFAS et de gérer des espaces de travail et des données environnementales.</p>
                    </div>
                    <div class="footer-hyperlinks">
                        <a href="legal_mentions.php" class="footer-link">Mentions Légales</a>
                        <a href="?.php" class="footer-link">Plan du site</a>
                        <p>© 2026 - Tous droits réservés</p>
                    </div>
                    <a href="#top" class="footer-link return-top">↑</a>
                </footer>
            </body>
        </html>
        <?php
    }
}