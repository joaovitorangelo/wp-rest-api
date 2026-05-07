<?php
/**
 * Plugin Name: WP REST API
 */

defined('ABSPATH') || exit;

require_once __DIR__ . '/vendor/autoload.php';

use TokDigital\WpRestApi\Core\Application;

$app = new Application();
$app->boot();