<?php

namespace Module\Exceptions;

use Throwable;

class ValidationException extends BaseException
{
    public function __construct($httpStatusCode, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($httpStatusCode, $message, $code, $previous);
    }
}
