<?php
function loadEnv(string $path): void
{
    if (!is_readable($path)){
        throw new RuntimeException('Fichier .env introuvable ou illisible.');
    }
    //on récupère toutes les lignes du fichier qu'on met dans un tableau
    foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#') || ! str_contains($line, '=')) {
            continue;
        }
        //on coupe en 2 la ligne dès qu'on repère un "="
        [$key, $value] = explode ('=', $line, 2);
        //on stock la valeur sous le nom de la clé
        $_ENV[trim($key)] = trim($value, " \t\"'");
    }
}

loadEnv(__DIR__ . '/../../.env');