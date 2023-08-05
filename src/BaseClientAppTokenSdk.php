<?php

namespace YusamHub\Project0001ClientAuthSdk;

use YusamHub\Project0001ClientAuthSdk\Tokens\JwtAuthAppTokenHelper;

abstract class BaseClientAppTokenSdk extends BaseClientSdk
{
    /**
     * @param string $method
     * @param array|string $content
     * @return string
     */
    protected function generateToken(string $method, array|string $content): string
    {
        return JwtAuthAppTokenHelper::toJwt($this->identifierId, $this->privateKey, md5(parent::generateToken($method, $content)));
    }
}