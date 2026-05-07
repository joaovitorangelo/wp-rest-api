<?php

namespace TokDigital\WpRestApi\Providers;

defined('ABSPATH') || exit;

class RouteServiceProvider
{
    public function register()
    {
        require_once dirname(__DIR__, 2) . '/routes/api.php';
    }
}