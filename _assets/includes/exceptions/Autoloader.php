<?php

spl_autoload_register(function ($class_name): void {

    $root_directory = dirname(__DIR__, 3);

    $file_name = str_replace('\\', '/', $class_name);

    // tous les chemins possibles
    $options = [
        // pour les classes dans modules
        $root_directory . '/modules/' . $file_name . '.php',

        // les classes dans _assets
        $root_directory . '/_assets/' . $file_name . '.php',

        // en cas de non trouvaille du fichier
        $root_directory . '/_assets/includes/exceptions/' . basename($file_name) . '.php',
        $root_directory . '/modules/blog/controllers/' . basename($file_name) . '.php',
        $root_directory . '/modules/blog/models/' . basename($file_name) . '.php',
        $root_directory . '/modules/blog/views/' . basename($file_name) . '.php'
    ];

    foreach ($options as $file_path) {
        if (file_exists($file_path)) {
            require_once $file_path;
            return;
        }
    }
});