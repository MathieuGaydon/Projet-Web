<?php
namespace blog\controllers;
 
use blog\views\ResetPsw as ResetPswView;
 
class ResetPsw {
    public function execute(): void {
        $valide = false;
        $mdp = $_POST['new-psw'] ?? '';
        $confirmation = $_POST['new-psw-confim'] ?? '';
        //code de verification du token (si le token est invalide $valide reste false)

        if ($mdp !== '' && $mdp === $confirmation) {
            // écriture dans la bdd du hash du nouveau mdp
            // $valide = true si le changement de mdp est enregistré, false sinon
            $valide = true; // temporaire
        }
        (new ResetPswView($valide))->show();
    }
}