<?php

namespace Nahid\Popo\Exceptions;

use Throwable;

class UnknownEntityException extends \Exception
{
    public function __construct($message = "Given entity is unknown", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}