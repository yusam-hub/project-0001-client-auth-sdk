<?php

namespace YusamHub\Project0001ClientAuthSdk;

class ClientAuthApiAppSdk extends BaseClientAppTokenSdk
{
    /**
     * @param int $uid
     * @param string $did
     * @return array|null
     */
    public function getUserKey(int $uid, string $did): ?array
    {
        return $this->doAppRequest(
            $this->api::METHOD_GET,
            '/api/app/user-key',
            get_defined_vars(),
            true
        );
    }
}