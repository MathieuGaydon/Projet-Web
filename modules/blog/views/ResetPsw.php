<?php
namespace blog\views;

class ResetPsw {
    public bool $valide;

    public function __construct(bool $valide) {
        $this->valide = $valide;
    }


    public function show(): void {
        $description = "Réinitialisation du mot de passe PFAS-Explorer.";
        $sm_title = "PFAS-Explorer - Réinitialisation";
        $sm_description = $description;
        $sm_image = "https://projetwebtestperso.alwaysdata.net/_assets/images/Logo_PFAS.webp";
        $sm_url = "https://projetwebtestperso.alwaysdata.net/index.php?action=reset-psw";
        $info_button_1 = "homepage";
        $button_1 = "Accueil";
        $info_button_2 = "connexion";
        $button_2 = "Se Connecter";
        $button_3 = "Se Déconnecter";
        ob_start();

        if ($this->valide) {
            $title = "Changement validé";
            ?>
            <section class="reset-psw">
                <p>Mot de passe réinitialisé.<br> Merci de vous <a href="index.php?action=connexion">reconnecter</a> avec le nouveau mot de passe</p>
            </section>
            <?php
        } else {
            $title = "Un problème est survenu";
            ?>
            <section class="reset-psw">
                <p><a href="index.php?action=mdp-oublie">Nouvelle tentative</a></p>
            </section>
            <?php
        }

        $content = ob_get_clean();
        (new Layout($title, $description, $sm_title, $sm_description, $sm_image, $sm_url, $info_button_1, $button_1, $info_button_2, $button_2, $content, $button_3))->show();
    }
}