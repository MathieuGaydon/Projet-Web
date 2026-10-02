<?php
namespace Blog\Views;

class Login {
    public function show(): void {
        $title = "Connexion";
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
            <form action="data-processing.php" method="post">
                <ul>
                    <li>
                        <label for="mail">E-mail :</label>
                        <input type="email" id="mail" name="user_mail" required/>
                    </li>
                    <li>
                        <label for="psw">Mot de passe :</label>
                        <input type="password" id="psw" name="user_psw" required/>
                        <br/>
                        <a href="<?php echo $mdpaddr;?>"><?php echo $mdp;?></a>
                    </li>
                </ul>
                <input type="submit" id="send" value="Se connecter"
            </form>
            <p>Pas encore inscrit ? <a href="<?php echo $iaddr;?>"><?php echo $i;?></a></p>
        </section>
        <?php
        $content = ob_get_clean();

        (new Layout($title, $content))->show();
    }
}