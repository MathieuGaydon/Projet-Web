<?php
namespace Blog\Views;

class Plan {
    public function show(): void {
        $title = "Plan du site";
        $a = 'Se connecter';
        $aaddr = 'index.php?action=connexion';
        $i = 'S\'inscrire';
        $iaddr = 'index.php?action=inscription';
        $p = 'Plan du site';
        $paddr = 'index.php?action=plan';
        $mdp = 'Mot de passe oublié';
        $mdpaddr = 'index.php?action=mdp-oublie';
        $ml = 'Mentions légales';
        $mladdr = 'inserer_adresse_page_correspondante';
        $h = 'Menu principal';
        $haddr = 'index.php';

        ob_start();
        ?>
        <section class="hero">
            <a href="<?php echo $haddr;?>"><?php echo $h;?></a>
            <a href="<?php echo $aaddr;?>"><?php echo $a;?></a>
            <a href="<?php echo $iaddr;?>"><?php echo $i;?></a>
            <a href="<?php echo $mdpaddr;?>"><?php echo $mdp;?></a>
            <a href="<?php echo $mladdr;?>"><?php echo $ml;?></a>
        </section>
        <?php
        $content = ob_get_clean();

        (new Layout($title, $content))->show();
    }
}

