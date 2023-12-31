<?php

namespace App\utils;

class ValidationTool
{
    /**
     * Validate an email address using PHP's built-in filter function.
     *
     * @param string $email The email address to validate.
     * @return bool True if the email is valid, false otherwise.
     */
    public static function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
