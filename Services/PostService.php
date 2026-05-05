<?php

namespace TokDigital\Services;

use TokDigital\Repositories\PostRepository;
use TokDigital\Validators\PostValidator;

class PostService {

    private $repo;

    public function __construct() {
        $this->repo = new PostRepository();
    }

    public function getAll() {
        return $this->repo->all();
    }

    public function create($data) {
        PostValidator::validate($data);
        return $this->repo->create($data);
    }
}