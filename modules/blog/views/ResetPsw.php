<?php
namespace blog\views;

class ResetPsw {
    public bool $valide;

    public function __construct(bool $valide) {
        $this->valide = $valide;
    }


    public function show(): void {
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
        (new Layout($title, $content))->show();
    }
}