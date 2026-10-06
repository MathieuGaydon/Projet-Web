<?php
namespace blog\views;
 
class Reset {
    public function show(): void {
        $title = "PFAS-Explorer - Nouveau mot de passe";
        $description = "Choisissez un nouveau mot de passe PFAS-Explorer.";
        $sm_title = $title;
        $sm_description = $description;
        $sm_image = "https://projetwebtestperso.alwaysdata.net/_assets/images/Logo_PFAS.webp";
        $sm_url = "https://projetwebtestperso.alwaysdata.net/index.php?action=reset";
        $info_button_1 = "homepage";
        $button_1 = "Accueil";
        $info_button_2 = "connexion";
        $button_2 = "Se Connecter";
        $button_3 = "Se Déconnecter";
        ob_start();
        ?>
        <section class="reset">
            <form action="index.php?action=reset-psw" method="post">
                <label for="new-psw">Nouveau mot de passe</label>
                <input type="password" id="new-psw" name="new-psw" required>

                <label for="new-psw-confim">Confirmer le mot de passe</label>
                <input type="password" id="new-psw-confim" name="new-psw-confim" required>
 
                <button type="submit">Valider le chagement</button>

            </form>
        </section>
        <?php
        $content = ob_get_clean();
 
        (new Layout($title, $description, $sm_title, $sm_description, $sm_image, $sm_url, $info_button_1, $button_1, $info_button_2, $button_2, $content, $button_3))->show();
    }
}
