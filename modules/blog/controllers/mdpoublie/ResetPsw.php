<?php
namespace blog\controllers\mdpoublie;
 
use blog\views\ResetPsw as ResetPswView;
 
class ResetPsw {
    public function execute(): void {
        $valide = false;
        $mdp = $_POST['new-psw'] ?? '';
        $confirmation = $_POST['new-psw-confim'] ?? '';
        //code de verification du token
        //(si le token est invalide, $valide reste false)

        // vérification du caractère identique des mots de passe
        if ($mdp !== '' && $mdp === $confirmation) {
            // a completer
            // écriture dans la bdd du hash du nouveau mdp
            // $valide = true si le changement de mdp est enregistré
            // false sinon
            $valide = true; // temporaire
        }
        (new ResetPswView($valide))->show();
    }
}