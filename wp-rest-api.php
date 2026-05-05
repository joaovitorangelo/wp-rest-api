<?php
/**
 * Plugin Name: WP REST API
 */

defined('ABSPATH') || exit;

spl_autoload_register(function ($class) {

    $prefix = 'TokDigital\\';
    $base_dir = __DIR__ . '/';

    // verifica se começa com TokDigital\
    if (strpos($class, $prefix) !== 0) {
        return;
    }

    // remove TokDigital\
    $relative_class = substr($class, strlen($prefix));

    // troca \ por /
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

// rotas continuam manual
require_once __DIR__ . '/routes/products-route.php';