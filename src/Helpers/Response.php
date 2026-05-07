<?php

namespace TokDigital\WpRestApi\Helpers;

defined('ABSPATH') || exit;

class Response
{
    public static function success(
        mixed $data = [],
        int $status = 200,
        array $meta = []
    ): \WP_REST_Response {

        return new \WP_REST_Response([
            'success' => true,
            'data'    => $data,
            'meta'    => $meta
        ], $status);
    }

    public static function error(
        string $message,
        int $status = 400,
        array $errors = []
    ): \WP_REST_Response {

        return new \WP_REST_Response([
            'success' => false,
            'message' => $message,
            'errors'  => $errors
        ], $status);
    }
}