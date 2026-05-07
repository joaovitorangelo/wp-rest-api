<?php

namespace TokDigital\WpRestApi\Validators;

defined('ABSPATH') || exit;

class PostValidator
{
    public static function validate(array $data): void
    {
        if (!isset($data['title'])) {
            throw new \Exception('Title is required');
        }

        $title = trim($data['title']);

        if ($title === '') {
            throw new \Exception('Title cannot be empty');
        }

        if (mb_strlen($title) < 3) {
            throw new \Exception('Title must be at least 3 characters');
        }
    }
}