<?php

namespace TokDigital\Validators;

use Exception;

class PostValidator {

    public static function validate($data) {

        if (empty($data['title'])) {
            throw new Exception('Title is required');
        }

        if (strlen($data['title']) < 3) {
            throw new Exception('Title must be at least 3 characters');
        }
    }
}