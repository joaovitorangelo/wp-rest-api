<?php

add_action('rest_api_init', function () {

    register_rest_route(API_NAMESPACE, '/products', [
        [
            'methods'  => 'GET',
            'callback' => ['ProductController', 'index'],
            'permission_callback' => function () {
                return current_user_can('read');
            }
        ],
        [
            'methods'  => 'POST',
            'callback' => ['ProductController', 'store'],
            'permission_callback' => function () {
                return current_user_can('edit_posts');
            }
        ]
    ]);
});