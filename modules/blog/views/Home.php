<?php
namespace blog\views;

class Homepage {
    public function show(): void {
        $title = "PFAS-Explorer - Accueil";
        $description = "PFAS-Explorer est une application web cartographique permettant d'explorer les contaminations aux PFAS et de gérer des espaces de travail et des données environnementales.";
        $sm_title = "PFAS-Explorer - Accueil";
        $sm_description = "PFAS-Explorer est une application web cartographique permettant d'explorer les contaminations aux PFAS et de gérer des espaces de travail et des données environnementales.";
        $sm_image = "https://projetwebtestperso.alwaysdata.net/Logo_PFAS.webp";
        $sm_url = "https://projetwebtestperso.alwaysdata.net/";
        $button_1 = "S'inscrire";
        $button_2 = "Se Connecter";
        $button_3 = "Se Déconnecter";

        ob_start();
        ?>
        <div class="home">
                <h2>Accueil</h2>
                <p>PFAS-Explorer est une application web cartographique permettant d'explorer les contaminations aux PFAS et de gérer des espaces de travail et des données environnementales.</p>
        </div>
        <?php
        $content = ob_get_clean();

        (new Layout($title, $description, $sm_title, $sm_description, $sm_image, $sm_url, $button_1, $button_2, $content, $button_3))->show();
    }
}