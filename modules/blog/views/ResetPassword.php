<?php
namespace blog\views;

class ResetPassword {
    public function show(array $errors = [], string $csrf_token = ''): void {
        $title = "PFAS-Explorer - Nouveau mot de passe";
        $description = "Choisissez un nouveau mot de passe pour votre compte PFAS-Explorer.";
        $sm_title = "PFAS-Explorer - Nouveau mot de passe";
        $sm_description = "Choisissez un nouveau mot de passe pour votre compte PFAS-Explorer.";
        $sm_image = "https://projetwebtestperso.alwaysdata.net/_assets/images/Logo_PFAS.webp";
        $sm_url = "https://projetwebtestperso.alwaysdata.net/index.php?action=reinitialisation_mdp";
        $info_button_1 = "homepage";
        $button_1 = "Accueil";
        $info_button_2 = "connexion";
        $button_2 = "Se Connecter";
        $button_3 = "Se Déconnecter";
        $extra_css = "login";
        ob_start();
        ?>
        <h2>Nouveau mot de passe</h2>

        <?php if (!empty($errors)): ?>
            <div class="form-errors">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="index.php?action=reinitialisation_mdp" method="post">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
            <div>
                <label for="password">Nouveau mot de passe :</label>
                <input type="password" name="password" id="password" autocomplete="new-password" required>
            </div>
            <div>
                <label for="password_verification">Confirmation du mot de passe :</label>
                <input type="password" name="password_verification" id="password_verification" autocomplete="new-password" required>
            </div>
            <div>
                <input type="submit" value="Modifier le mot de passe">
            </div>
        </form>
        <?php
        $content = ob_get_clean();
        (new Layout($title, $description, $sm_title, $sm_description, $sm_image, $sm_url, $info_button_1, $button_1, $info_button_2, $button_2, $content, $button_3, $extra_css))->show();
    }
}