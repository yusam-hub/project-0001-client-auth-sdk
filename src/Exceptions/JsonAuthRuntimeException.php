<?php

namespace YusamHub\Project0001ClientAuthSdk\Exceptions;

class JsonAuthRuntimeException extends AuthRuntimeException
{
    public function __construct(array $data, int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), $code, $previous);
    }
}