<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class InvalidRankException extends Exception
{
    public function __construct(
        string $message = 'Invalid rank in one of the cards',
        int $code = 404,
        Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }
}
