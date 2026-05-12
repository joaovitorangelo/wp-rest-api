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
        
        $this->registerDocs();
    }

    private function loadConfig()
    {
        require_once dirname(__DIR__, 2)
             . '/config/app.php';
    }

    private function registerProviders()
    {
        (new RouteServiceProvider())->register();
    }

    private function registerDocs()
    {
        add_action('admin_menu', function () {

            add_menu_page(

                'API Docs',

                'API Docs',

                'manage_options',

                'api-docs',

                function () {

                    require_once
                        WP_REST_API_PLUGIN_PATH
                        . 'storage/docs.php';

                },

                'dashicons-rest-api'
            );
        });
    }
}