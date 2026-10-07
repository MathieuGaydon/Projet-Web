<?php
namespace blog\views;

class Profile {
    /**
     * @param array<string> $errors
     */
    public function show(object $user, array $errors = []): void {
        $title = "PFAS-Explorer - Mon Profil";
        $description = "Consultez vos informations personnelles et gérez votre compte sur PFAS-Explorer.";
        $sm_title = "PFAS-Explorer - Mon Profil";
        $sm_description = "Consultez vos informations personnelles et gérez votre compte sur PFAS-Explorer.";
        $sm_image = "https://pfas-explorer.alwaysdata.net/_assets/images/Logo_PFAS.webp";
        $sm_url = "https://pfas-explorer.alwaysdata.net/index.php?action=profil";
        $info_button_1 = "homepage";
        $button_1 = "Accueil";
        $info_button_2 = "deconnexion";
        $button_2 = "Se Déconnecter";
        $button_3 = "Se Déconnecter";

        ob_start();
        ?>
        <?php if (!empty($errors)): ?>
            <div class="error">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="profile">
            <h2>Mon Profil</h2>

            <section class="profile-info">
                <h3>Informations personnelles</h3>
                <p>Nom : <?= htmlspecialchars(isset($user->last_name) && is_string($user->last_name) ? $user->last_name : ''); ?></p>
                <p>Prénom : <?= htmlspecialchars(isset($user->first_name) && is_string($user->first_name) ? $user->first_name : ''); ?></p>
                <p>E-mail : <?= htmlspecialchars(isset($user->email) && is_string($user->email) ? $user->email : ''); ?></p>
                <p>Téléphone : <?= htmlspecialchars(isset($user->phone_number) && is_string($user->phone_number) ? $user->phone_number : '');; ?></p>
                <?php
                    $timestamp = strtotime(isset($user->created_at) && is_string($user->created_at) ? $user->created_at : '');
                    $formattedDate = ($timestamp !== false) ? date('d/m/Y', $timestamp) : '-';
                ?>
                <?php if (!empty($user->created_at)): ?>
                    <p><strong>Membre depuis le :</strong> <?= $formattedDate; ?></p>
                <?php endif; ?>
            </section>

            <section class="delete-info">
                <h3>Supprimer mon compte</h3>
                <p>Attention, cette action est irréversible. Toutes vos données seront définitivement supprimées.</p>

                <form method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ?');">
                    <div>
                        <label for="password">Confirmez votre mot de passe :</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                    <br>
                    <div>
                        <input type="submit" name="delete_account" value="Supprimer définitivement mon compte">
                    </div>
                </form>
            </section>
        </div>
        <?php
        $content = ob_get_clean();

        (new Layout(
            $title,
            $description,
            $sm_title,
            $sm_description,
            $sm_image,
            $sm_url,
            $info_button_1,
            $button_1,
            $info_button_2,
            $button_2,
            $content,
            $button_3
        ))->show();
    }
}