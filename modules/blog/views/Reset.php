<?php
namespace blog\views;
 
class Reset {
    public function show(): void {
        $title = "Changement du mot de passe";
 
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
 
        (new Layout($title, $content))->show();
    }
}
