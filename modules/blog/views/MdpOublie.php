<?php
namespace blog\views;
 
class MdpOublie {
    public function show(): void {
        $title = "Mot de passe oublié";
 
        ob_start();
        ?>
        <section class="mdp-oublie">
            <h2>Mot de passe oublié</h2>
 
            <form action="index.php?action=mdp-oublie" method="post">
                <label for="email">Adresse-mail</label>
                <input type="email" id="email" name="email" placeholder="Entrez-ici" required>
 
                <button type="submit">Envoyer mail de<br>récupération</button>
                <a href="index.php?action=connexion">Se connecter ?</a>
            </form>
        </section>
        <?php
        $content = ob_get_clean();
 
        (new Layout($title, $content))->show();
    }
}
