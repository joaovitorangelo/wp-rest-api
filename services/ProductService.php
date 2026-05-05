<?php

namespace TokDigital\Services;

use TokDigital\Repositories\ProductRepository;
use TokDigital\Validators\ProductValidator;

class ProductService {

    private $repo;

    public function __construct() {
        $this->repo = new ProductRepository();
    }

    public function getAll() {
        return $this->repo->all();
    }

    public function create($data) {
        ProductValidator::validate($data);
        return $this->repo->create($data);
    }
}