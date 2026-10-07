<?php
namespace blog\views;

class SiteMap {
    public function show(): void {
        $title = "PFAS-Explorer - Plan du site";
        $description = "Plan du site PFAS-Explorer.";
        $sm_title = "PFAS-Explorer - Plan du site";
        $sm_description = "Plan du site PFAS-Explorer.";
        $sm_image = "https://pfas-explorer.alwaysdata.net/_assets/images/Logo_PFAS.webp";
        $sm_url = "https://pfas-explorer.alwaysdata.net/index.php?action=sitemap";
        $info_button_1 = "homepage";
        $button_1 = "Accueil";
        $info_button_2 = "inscription";
        $button_2 = "S'Inscrire/Se Connecter";
        $button_3 = "Se Déconnecter";

        ob_start();
        ?>
        <div class="sitemap">
                <h2>Plan du site</h2>
                <ul>
                    <li><a href="index.php?action=homepage" class="sitemap-link">Accueil</a></li>
                    <li><a href="index.php?action=inscription" class="sitemap-link">Inscription</a></li>
                    <li><a href="index.php?action=connexion" class="sitemap-link">Authentification</a></li>
                    <li><a href="index.php?action=mot_de_passe_oublie" class="sitemap-link">Mot de passe oublié</a></li>
                    <li><a href="index.php?action=legalnotice" class="sitemap-link">Mentions Légales</a></li>
                    <li><a href="index.php?action=sitemap" class="sitemap-link">Plan du site</a></li>
                </ul>
        </div>
        <?php
        $content = ob_get_clean();

        (new Layout($title, $description, $sm_title, $sm_description, $sm_image, $sm_url, $info_button_1, $button_1, $info_button_2, $button_2, $content, $button_3))->show();
    }
}