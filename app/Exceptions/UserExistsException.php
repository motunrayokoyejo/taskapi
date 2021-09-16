<?php

namespace App\Exceptions;


class UserExistException extends \RuntimeException
{
   public static function userAlreadyExistException(string $message)
   {

       return new static($message, 407);
       
   }
}
