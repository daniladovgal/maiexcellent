<?php

namespace App\Common\V1\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException as KernelHttpException;

class HttpException extends KernelHttpException
{
    public static function create(
        int $statusCode,
        string $message = '',
        ?\Throwable $previous = null,
        array $headers = [],
        int $code = 0
    ) {
        throw static::fromStatusCode($statusCode, $message, $previous, $headers, $code);
    }
}
