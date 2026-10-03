<?php
namespace Blog\Views;

class Homepage {
    public function show(): void {
        $title = "Accueil - Ma page";

        ob_start();
        ?>
        <section class="hero">
            <h1>Bienvenue sur la page</h1>
            <p>Test</p>
        </section>
        <?php
        $content = ob_get_clean();

        (new Layout($title, $content))->show();
    }
}