<?php

namespace TokDigital\Repositories;

use WP_Query;
use Exception;

class ProductRepository {

    public function all() {

        $query = new WP_Query([
            'post_type' => 'product',
            'posts_per_page' => -1
        ]);

        return array_map(function ($post) {
            return [
                'id' => $post->ID,
                'title' => $post->post_title
            ];
        }, $query->posts);
    }

    public function create($data) {

        $post_id = wp_insert_post([
            'post_type'   => 'product',
            'post_title'  => sanitize_text_field($data['title']),
            'post_status' => 'publish'
        ]);

        if (is_wp_error($post_id)) {
            throw new Exception('Erro ao criar produto');
        }

        return [
            'id' => $post_id
        ];
    }
}