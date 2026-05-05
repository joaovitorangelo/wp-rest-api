<?php

use TokDigital\Controllers\ProductController;

add_action('rest_api_init', function () {

    register_rest_route(API_NAMESPACE, '/products', [
        [
            'methods'  => 'GET',
            'callback' => [ProductController::class, 'index'],
            'permission_callback' => function () {
                return current_user_can('read');
            }
        ],
        [
            'methods'  => 'POST',
            'callback' => [ProductController::class, 'store'],
            'permission_callback' => function () {
                return current_user_can('edit_posts');
            }
        ]
    ]);
});