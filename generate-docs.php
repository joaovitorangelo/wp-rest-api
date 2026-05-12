<?php

define('ABSPATH', __DIR__);

require_once __DIR__ . '/vendor/autoload.php';

use OpenApi\Generator;

$generator = new Generator();

$openapi = $generator->generate([
    __DIR__ . '/src'
]);

var_dump( $openapi );

file_put_contents(
    __DIR__ . '/storage/openapi.json',
    $openapi->toJson()
);

echo "OpenAPI gerado com sucesso";