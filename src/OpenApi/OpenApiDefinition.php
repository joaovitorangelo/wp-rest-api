<?php

namespace TokDigital\WpRestApi\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'WP REST API'
)]

#[OA\Server(
    url: 'http://local.tokdigital.cc/homefinish/2026/wp-json/my-api/v1'
)]

class OpenApiDefinition
{
}