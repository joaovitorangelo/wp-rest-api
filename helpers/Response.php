<?php

namespace TokDigital\Helpers;

use WP_REST_Response;

class Response {

    public static function success($data = [], $status = 200) {
        return new WP_REST_Response([
            'success' => true,
            'data'    => $data
        ], $status);
    }

    public static function error($message, $status = 400) {
        return new WP_REST_Response([
            'success' => false,
            'error'   => $message
        ], $status);
    }
}