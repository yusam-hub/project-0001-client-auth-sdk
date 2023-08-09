<?php

namespace YusamHub\Project0001ClientAuthSdk;

class ClientAuthAppSdk extends BaseClientAppTokenSdk
{
    /**
     * @param string $accessToken
     * @return array|null
     */
    public function getApiAppAccessToken(string $accessToken): ?array
    {
        return $this->doBaseRequest(
            $this->api::METHOD_GET,
            '/api/app/access-token',
            get_defined_vars(),
            true
        );
    }
}