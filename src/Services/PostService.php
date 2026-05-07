<?php

namespace TokDigital\WpRestApi\Services;

defined('ABSPATH') || exit;

use TokDigital\WpRestApi\Repositories\PostRepository;
use TokDigital\WpRestApi\Validators\PostValidator;

class PostService
{
    private PostRepository $repo;

    public function __construct()
    {
        $this->repo = new PostRepository();
    }

    public function getAll(): array
    {
        return $this->repo->all();
    }

    public function create(array $data): array
    {
        PostValidator::validate($data);

        $data['title'] = sanitize_text_field($data['title']);

        return $this->repo->create($data);
    }
}