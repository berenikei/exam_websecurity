<?php

class CSRFToken
{
    public static function generate_token()
    {
        // create a key for hash_hmac
        if (empty($_SESSION['key'])) {
            $_SESSION['key'] = bin2hex(random_bytes(32));
        }

        // create CSRF key
        $_SESSION['key'] = $csrf = hash_hmac('sha256', 'login', $_SESSION['key']);
        return $csrf;
    }

    public static function force_generate_token()
    {
        // create a key for hash_hmac
        $_SESSION['key'] = bin2hex(random_bytes(32));
        // create CSRF key
        $csrf = hash_hmac('sha256', 'login', $_SESSION['key']);
        return $csrf;
    }
}