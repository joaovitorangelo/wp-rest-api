<?php

namespace TokDigital\WpRestApi\Controllers;

defined('ABSPATH') || exit;

use TokDigital\WpRestApi\Helpers\Response;
use TokDigital\WpRestApi\Services\PostService;

class PostController
{
    private PostService $service;

    public function __construct()
    {
        $this->service = new PostService();
    }

    public function index(\WP_REST_Request $request)
    {
        try {

            $data = $this->service->getAll();

            return Response::success($data);

        } catch (\Exception $e) {

            return Response::error($e->getMessage(), 500);

        }
    }

    public function store(\WP_REST_Request $request)
    {
        try {

            $params = $request->get_json_params();

            $data = $this->service->create($params);

            return Response::success($data, 201);

        } catch (\Exception $e) {

            return Response::error($e->getMessage(), 400);

        }
    }
}