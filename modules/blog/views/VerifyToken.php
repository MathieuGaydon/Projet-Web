<?php
namespace blog\views;

class VerifyToken {
    public function show(array $errors = [], string $email = '', string $csrf_token = ''): void {
        $title = "PFAS-Explorer - Vérification du code";
        $description = "Saisissez le code reçu par email pour réinitialiser votre mot de passe.";
        $sm_title = "PFAS-Explorer - Vérification du code";
        $sm_description = "Saisissez le code reçu par email pour réinitialiser votre mot de passe.";
        $sm_image = "https://projetwebtestperso.alwaysdata.net/_assets/images/Logo_PFAS.webp";
        $sm_url = "https://projetwebtestperso.alwaysdata.net/index.php?action=mot_de_passe_oublie";
        $info_button_1 = "homepage";
        $button_1 = "Accueil";
        $info_button_2 = "connexion";
        $button_2 = "Se Connecter";
        $button_3 = "Se Déconnecter";
        $extra_css = "login";
        ob_start();
        ?>
        <h2>Vérification du code</h2>

        <?php if (!empty($errors)): ?>
            <div class="form-errors">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="index.php?action=verification_token" method="post">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
            <p class="form-info">
                Un code vous a été envoyé à <strong><?= htmlspecialchars($email) ?></strong>. Il est valable pendant 15 minutes. Pensez à vérifier vos courriers indésirables.</p>
            <div>
                <label for="token">Code de vérification :</label>
                <input type="text" name="token" id="token" placeholder="A3F9C21B" autocomplete="off" required>
            </div>
            <div>
                <input type="submit" value="Vérifier le code">
            </div>
        </form>
        <?php
        $content = ob_get_clean();
        (new Layout($title, $description, $sm_title, $sm_description, $sm_image, $sm_url, $info_button_1, $button_1, $info_button_2, $button_2, $content, $button_3, $extra_css))->show();
    }
}