<?php

namespace YusamHub\Project0001ClientAuthSdk;

class ClientAuthApiAppSdk extends BaseClientAppTokenSdk
{
    /**
     * @param string $accessToken
     * @return array|null
     */
    public function getAccessToken(string $accessToken): ?array
    {
        return $this->doAppRequest(
            $this->api::METHOD_GET,
            '/api/app/access-token',
            get_defined_vars(),
            true
        );
    }
}