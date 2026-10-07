<?php
namespace blog\views;

class ForgotPassword {
    public function show(array $errors = [], string $email = '', string $csrf_token = ''): void {
        $title = "PFAS-Explorer - Mot de passe oublié";
        $description = "Réinitialisez votre mot de passe de votre compte PFAS-Explorer.";
        $sm_title = "PFAS-Explorer - Mot de passe oublié";
        $sm_description = "Réinitialisez votre mot de passe de votre compte PFAS-Explorer.";
        $sm_image = "https://pfas-explorer.alwaysdata.net/_assets/images/Logo_PFAS.webp";
        $sm_url = "https://pfas-explorer.alwaysdata.net/index.php?action=mot_de_passe_oublie";
        $info_button_1 = "homepage";
        $button_1 = "Accueil";
        $info_button_2 = "connexion";
        $button_2 = "Se Connecter";
        $button_3 = "Se Déconnecter";
        ob_start();
        ?>
        <h2>Mot de passe oublié</h2>

        <?php if (!empty($errors)): ?>
            <div class="form-errors">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="index.php?action=mot_de_passe_oublie" method="post">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
            <p class="form-info">
                Saississez l'adresse email de votre compte. Nous vous enverrons un code de vérification.</p>
            <div>
                <label for="email">E-mail :</label>
                <input type="email" id="email" name="email" placeholder="mail@exemple.com" value="<?= htmlspecialchars($email) ?>" required>
            </div>
            <div>
                <input type="submit" value="Envoyer le code">
            </div>
        </form>
        <?php
        $content = ob_get_clean();
        (new Layout($title, $description, $sm_title, $sm_description, $sm_image, $sm_url, $info_button_1, $button_1, $info_button_2, $button_2, $content, $button_3))->show();
    }
}