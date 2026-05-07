<?php

namespace TokDigital\WpRestApi\Core;

defined('ABSPATH') || exit;

use TokDigital\WpRestApi\Providers\RouteServiceProvider;

class Application
{
    public function boot()
    {
        $this->loadConfig();
        $this->registerProviders();
    }

    private function loadConfig()
    {
        require_once dirname(__DIR__, 2) . '/config/app.php';
    }

    private function registerProviders()
    {
        (new RouteServiceProvider())->register();
    }
}