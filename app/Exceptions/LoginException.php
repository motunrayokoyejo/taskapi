<?php

namespace App\Exceptions;

use Exception;

class LoginException extends \RuntimeException
{
   public static function userNotFoundException(string $message)
   {

       return new static($message, 404);
       
   }
}
