<?php

namespace TokDigital\WpRestApi\Controllers;

defined('ABSPATH') || exit;

use OpenApi\Attributes as OA;

use TokDigital\WpRestApi\Helpers\Response;
use TokDigital\WpRestApi\Services\PostService;

class PostController
{
    private PostService $service;

    public function __construct()
    {
        $this->service = new PostService();
    }

    #[OA\Get(
        path: '/posts',
        summary: 'Lista posts',
        tags: ['Posts']
    )]

    #[OA\Response(
        response: 200,
        description: 'Lista retornada',

        content: new OA\JsonContent(

            properties: [

                new OA\Property(
                    property: 'success',
                    type: 'boolean',
                    example: true
                ),

                new OA\Property(
                    property: 'data',
                    type: 'array',

                    items: new OA\Items(

                        properties: [

                            new OA\Property(
                                property: 'id',
                                type: 'integer',
                                example: 1
                            ),

                            new OA\Property(
                                property: 'title',
                                type: 'string',
                                example: 'Meu post'
                            )
                        ]
                    )
                )
            ]
        )
    )]

    public function index(\WP_REST_Request $request)
    {
        try {

            $data = $this->service->getAll();

            return Response::success($data);

        } catch (\Exception $e) {

            return Response::error(
                $e->getMessage(),
                500
            );

        }
    }

    #[OA\Post(
        path: '/posts',
        summary: 'Criar post',
        tags: ['Posts']
    )]

    #[OA\RequestBody(
        required: true,

        content: new OA\JsonContent(

            required: ['title'],

            properties: [

                new OA\Property(
                    property: 'title',
                    type: 'string',
                    example: 'Novo Post'
                )
            ]
        )
    )]

    #[OA\Response(
        response: 201,
        description: 'Post criado',

        content: new OA\JsonContent(

            properties: [

                new OA\Property(
                    property: 'success',
                    type: 'boolean',
                    example: true
                ),

                new OA\Property(
                    property: 'data',

                    properties: [

                        new OA\Property(
                            property: 'id',
                            type: 'integer',
                            example: 15
                        )
                    ],

                    type: 'object'
                )
            ]
        )
    )]

    public function store(\WP_REST_Request $request)
    {
        try {

            $params = $request->get_json_params();

            $data = $this->service->create($params);

            return Response::success($data, 201);

        } catch (\Exception $e) {

            return Response::error(
                $e->getMessage(),
                400
            );

        }
    }
}