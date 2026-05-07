<?php

namespace TokDigital\WpRestApi\Repositories;

defined('ABSPATH') || exit;

class PostRepository 
{

    private string $postType = 'post';

    public function all(): array
    {
        $query = new WP_Query([
            'post_type'              => $this->postType,
            'posts_per_page'         => 20,
            'post_status'            => 'publish',
            'no_found_rows'          => true,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false
        ]);

        return array_map(function ($post) {

            return [
                'id'    => $post->ID,
                'title' => $post->post_title
            ];

        }, $query->posts);
    }

    public function create(array $data): array
    {
        $post_id = wp_insert_post([
            'post_type'   => $this->postType,
            'post_title'  => $data['title'],
            'post_status' => 'publish'
        ]);

        if (is_wp_error($post_id)) {
            throw new Exception('Erro ao criar post');
        }

        return [
            'id' => $post_id
        ];
    }
}