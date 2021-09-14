<?php

namespace App\Exceptions;


class FailedRegistrationException extends \RuntimeException

{
    public static function failedRegistration(string $message) : static 

    {

        return new static ($message, 500);

    }
}
