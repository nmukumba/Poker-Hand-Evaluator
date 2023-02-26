<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class InvalidSuitException extends Exception
{
    public function __construct(
        string $message = 'Invalid suit in one of the cards',
        int $code = 404,
        Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }
}
