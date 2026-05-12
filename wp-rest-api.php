<?php
/**
 * Plugin Name: WP REST API
 * Version: 1.0.2
 */

defined('ABSPATH') || exit;

define(
    'WP_REST_API_PLUGIN_URL',
    plugin_dir_url(__FILE__)
);

define(
    'WP_REST_API_PLUGIN_PATH',
    plugin_dir_path(__FILE__)
);

require_once __DIR__ . '/vendor/autoload.php';

use TokDigital\WpRestApi\Core\Application;

$app = new Application();

$app->boot();