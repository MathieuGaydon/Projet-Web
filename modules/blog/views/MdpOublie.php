<?php
namespace blog\views;
 
class MdpOublie {
    public function show(array $errors = [], string $message = ''): void {
        $title = "PFAS-Explorer - Mot de passe oublié";
        $description = "Réinitialisez votre mot de passe PFAS-Explorer.";
        $sm_title = $title;
        $sm_description = $description;
        $sm_image = "https://projetwebtestperso.alwaysdata.net/_assets/images/Logo_PFAS.webp";
        $sm_url = "https://projetwebtestperso.alwaysdata.net/index.php?action=mot_de_passe_oublie";
        $info_button_1 = "homepage";
        $button_1 = "Accueil";
        $info_button_2 = "inscription";
        $button_2 = "S'inscrire";
        $button_3 = "Se Déconnecter";

        ob_start();
        ?>
        <section class="mdp-oublie">
            <h2>Mot de passe oublié</h2>

            <?php foreach ($errors as $error): ?>
                <p class="form-errors"><?= htmlspecialchars($error) ?></p>
            <?php endforeach; ?>
            <?php if ($message !== ''): ?>
                <p><?= htmlspecialchars($message) ?></p>
            <?php endif; ?>

            <form action="index.php?action=mot_de_passe_oublie" method="post">
                <label for="email">Adresse e-mail</label>
                <input type="email" id="email" name="email" placeholder="mail@exemple.com" required>
                <button type="submit">Envoyer le mail de récupération</button>
                <a href="index.php?action=connexion">Se connecter ?</a>
            </form>
        </section>
        <?php
        $content = ob_get_clean();

        (new Layout($title, $description, $sm_title, $sm_description, $sm_image, $sm_url, $info_button_1, $button_1, $info_button_2, $button_2, $content, $button_3))->show();
    }
}