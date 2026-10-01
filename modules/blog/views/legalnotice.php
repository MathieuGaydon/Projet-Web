<?php
namespace Blog\Views;

class Legalnotice {
    public function show(): void {
        $title = "Mentions légales";
        $a = 'Se connecter';
        $aaddr = 'index.php?action=connexion';
        $i = 'S\'inscrire';
        $iaddr = 'index.php?action=inscription';
        $p = 'Plan du site';
        $paddr = 'index.php?action=plan';
        $mdp = 'Mot de passe oublié';
        $mdpaddr = 'index.php?action=mdp-oublie';
        $ml = 'Mentions légales';
        $mladdr = 'index.php?action=legalnotice';
        $h = 'Menu principal';
        $haddr = 'index.php';

        ob_start();
        ?>
        <section class="hero">
            <p>Insérer les mentions légales du site</p>
        </section>
        <?php
        $content = ob_get_clean();

        (new Layout($title, $content))->show();
    }
}
