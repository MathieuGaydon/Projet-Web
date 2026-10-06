<?php
namespace blog\views;

class Login {
    public function show(array $errors = [], string $email = '', string $csrf_token = ''): void{
        $title = "PFAS-Explorer - Connexion";
            $description = "Connectez-vous à votre PFAS-Explorer.";
            $sm_title = "PFAS-Explorer - Connexion";
            $sm_description = "Connectez-vous à votre PFAS-Explorer.";
            $sm_image = "https://projetwebtestperso.alwaysdata.net/_assets/images/Logo_PFAS.webp";
            $sm_url = "https://projetwebtestperso.alwaysdata.net/index.php?action=inscription";
            $info_button_1 = "homepage";
            $button_1 = "Accueil";
            $info_button_2 = "inscription";
            $button_2 = "S'inscrire";
            $button_3 = "Se Déconnecter";
            $extra_css = "login";
            ob_start();
            ?>
            <h2>Connexion</h2>

            <?php if (!empty($errors)): ?>
                <div class="form-errors">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach;?>
                    </ul>
                </div>
            <?php endif; ?>

        <form action="index.php?action=connexion" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token) ?>">
            <div>
                <label for="email">E-mail :</label>
                <input type="email" name="email" placeholder="mail@exemple.com" value="<?php echo htmlspecialchars($email) ?>" required>
            </div>
            <div>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div>
                <input type="submit" value="Se connecter">
            </div>
         </form>
        <div>
            <a href="index.php?action=mot_de_passe_oublie" class="btn-forgot-password">Mot de passe oublié</a>
        </div>
        <?php
        $content = ob_get_clean();
        (new Layout($title, $description, $sm_title, $sm_description, $sm_image, $sm_url, $info_button_1, $button_1, $info_button_2, $button_2, $content, $button_3, $extra_css))->show();
    }
}