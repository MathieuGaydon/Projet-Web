<?php
spl_autoload_register(function ($nomClasse) {

    $nomFichier = str_replace('\\', '/', $nomClasse);

    $option1 = __DIR__ . '/../../../modules/' . $nomFichier . '.php';
    $option2 = __DIR__ . '/../../../modules/' . strtolower($nomFichier) . '.php';
    $option3 = __DIR__ . '/../../../' . $nomFichier . '.php';

    $listeOptions = [$option1, $option2, $option3];

    foreach ($listeOptions as $cheminFichier) {
        if (file_exists($cheminFichier)) {
            require_once $cheminFichier;
            return;
        }
    }
});