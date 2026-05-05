<?php

use TokDigital\Controllers\PostController;

add_action('rest_api_init', function () {

    register_rest_route(API_NAMESPACE, '/posts', [
        [
            'methods'  => 'GET',
            'callback' => [PostController::class, 'index'],
            'permission_callback' => function () {
                return current_user_can('read');
            }
        ],
        [
            'methods'  => 'POST',
            'callback' => [PostController::class, 'store'],
            'permission_callback' => function () {
                return current_user_can('edit_posts');
            }
        ]
    ]);
});