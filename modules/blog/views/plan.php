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
        $mladdr = 'index.php?action=legalnotice';
        $h = 'Menu principal';
        $haddr = 'index.php';

        ob_start();
        ?>
        <section class="hero">
            <ul>
                <li><a href="<?php echo $haddr;?>"><?php echo $h;?></a></li>
                <li><a href="<?php echo $aaddr;?>"><?php echo $a;?></a></li>
                <li><a href="<?php echo $iaddr;?>"><?php echo $i;?></a></li>
                <li><a href="<?php echo $mdpaddr;?>"><?php echo $mdp;?></a></li>
                <li><a href="<?php echo $mladdr;?>"><?php echo $ml;?></a></li>
            </ul>
        </section>
        <?php
        $content = ob_get_clean();

        (new Layout($title, $content))->show();
    }
}

