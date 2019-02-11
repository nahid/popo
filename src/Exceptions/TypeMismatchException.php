<?php

namespace Nahid\Popo\Exceptions;

use Throwable;

class TypeMismatchException extends \Exception
{
    public function __construct($message = "Type miss match exception", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}