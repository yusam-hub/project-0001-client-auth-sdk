<?php

namespace YusamHub\Project0001ClientAuthSdk;

use YusamHub\Project0001ClientAuthSdk\Tokens\JwtAuthUserTokenHelper;

abstract class BaseClientUserTokenSdk extends BaseClientSdk
{
    /**
     * @param string $method
     * @param array|string $content
     * @return string
     */
    protected function generateUserToken(string $method, array|string $content): string
    {
        return JwtAuthUserTokenHelper::toJwt($this->identifierId, $this->privateKey, md5(parent::generateUserToken($method, $content)));
    }
}