<?php
namespace blog\views;

class Register{
    public function show(array $errors = []): void {
            $title = "PFAS-Explorer - Inscription";
            $description = "Inscrivez-vous dès maintenant sur le site PFAS-Explorer.";
            $sm_title = "PFAS-Explorer - Inscription";
            $sm_description = "Inscrivez-vous dès maintenant sur le site PFAS-Explorer.";
            $sm_image = "https://projetwebtestperso.alwaysdata.net/_assets/images/Logo_PFAS.webp";
            $sm_url = "https://projetwebtestperso.alwaysdata.net/index.php?action=inscription";
            $info_button_1 = "homepage";
            $button_1 = "Accueil";
            $info_button_2 = "connexion";
            $button_2 = "Se Connecter";
            $button_3 = "Se Déconnecter";
            ob_start();
            ?>
            <?php if (!empty($errors)): ?>
                <div style="color: red; margin-bottom: 15px;">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <form action="" method="post">
                <div>
                    <label for="last_name">Nom :</label>
                    <input type="text" name="last_name" id="last_name" placeholder="Dupont" required>
                </div>
                <div>
                    <label for="first_name">Prénom :</label>
                    <input type="text" name="first_name" id="first_name" placeholder="Jean" required>
                </div>
                <div>
                    <label for="email">E-mail :</label>
                    <input type="email" name="email" id="email" placeholder="mail@exemple.com" required>
                </div>
                <div>
                    <label for="password">Mot de passe :</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div>
                    <label for="password_verification">Vérification de mot de passe :</label>
                    <input type="password" name="password_verification" id="password_verification" required>
                </div>
                <div>
                    <label for="phone_number">Téléphone :</label>
                    <input type="tel" name="phone_number" id="phone_number" placeholder="0612345678" required> <!-- n pourrait ajouter un pattern -->
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" name="terms" id="terms" required>
                    <label for="terms">J'accepte les conditions générales</label><br><br>
                </div>
                <div>
                    <input type="submit" name="action" value="S'inscrire">
                </div>
            </form>
            <!-- en utilisant 'required', les conditions -->
            <?php
            $content = ob_get_clean();
        (new Layout($title, $description, $sm_title, $sm_description, $sm_image, $sm_url, $info_button_1, $button_1, $info_button_2, $button_2, $content, $button_3))->show();
    }
}