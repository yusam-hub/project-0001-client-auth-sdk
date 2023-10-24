<?php

namespace YusamHub\Project0001ClientAuthSdk;

class ClientAuthAppSdk extends BaseClientAppTokenSdk
{
    /**
     * @param int $userId
     * @param string $deviceUuid
     * @return array|null
     */
    public function getApiAppUserKey(int $userId, string $deviceUuid): ?array
    {
        return $this->doBaseRequest(
            $this->api::METHOD_GET,
            '/api/app/user-key',
            get_defined_vars(),
            true
        );
    }
}