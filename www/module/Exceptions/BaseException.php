<?php

namespace Module\Exceptions;

use Exception;
use Throwable;

class BaseException extends Exception
{
    protected $httpStatusCode;
    protected $title = "Module API";

    public function __construct($httpStatusCode, $message = "", $code = 0, Throwable $previous = null)
    {
        $this->httpStatusCode = $httpStatusCode;
        parent::__construct($message, $code, $previous);
    }


    public function getHttpStatusCode(): int
    {
        return $this->httpStatusCode;
    }

    public function getTitle(): string
    {
        if($this->title != null) {
            return $this->title;
        }
    }
}
