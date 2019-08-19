<?php

/*
 * Intended to prevent bots from spamming
 *
 */

class BotValidation
{
    public static function Verify($token)
    {
        // Google reCaptcha secret key
        $secretKey = "6LdagqIUAAAAAOdl28x6wSpjAq6ZmnOcWkIQNw3O";

        $statusMsg = '';
        // Get verify response data
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$token);
        $responseData = json_decode($verifyResponse);
        if ($responseData->success) {
            // it's not a robot, return true
            return true;
        } else {
            // it's a robot, return false
            return false;
        }
    }
}