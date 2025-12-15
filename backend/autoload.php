<?php

spl_autoload_register(function ($class) {

    $prefix = 'App\\';
    $baseDir = __DIR__ . '/src/';

    // verifica se a classe começa com App\
    if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
        return;
    }

    // remove o prefixo
    $relativeClass = substr($class, strlen($prefix));

    // converte namespace em caminho
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});
