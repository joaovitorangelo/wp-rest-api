<?php

namespace TokDigital\Controllers;

use TokDigital\Services\PostService;
use TokDigital\Helpers\Response;
use Exception;

class PostController {

    public static function index($request) {
        try {
            $service = new PostService();
            $data = $service->getAll();

            return Response::success($data);

        } catch (Exception $e) {
            return Response::error($e->getMessage(), 500);
        }
    }

    public static function store($request) {
        try {
            $params = $request->get_json_params();

            $service = new PostService();
            $data = $service->create($params);

            return Response::success($data, 201);

        } catch (Exception $e) {
            return Response::error($e->getMessage(), 400);
        }
    }
}