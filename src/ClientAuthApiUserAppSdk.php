<?php

namespace YusamHub\Project0001ClientAuthSdk;

class ClientAuthApiUserAppSdk extends BaseClientAuthApiAppSdk
{
    /**
     * @return array|null
     */
    public function getAppKeyList(): ?array
    {
        return $this->doAppRequest(
            $this->api::METHOD_GET,
            '/api/user/app/key/list',
            [],
            true
        );
    }

    /**
     * @param int $appId
     * @param string $deviceUuid
     * @return array|null
     */
    public function postAppIdRefresh(int $appId, string $deviceUuid): ?array
    {
        return $this->doAppRequest(
            $this->api::METHOD_POST,
            strtr('/api/user/app/id/{appId}/key-refresh', [
                '{appId}' => $appId
            ]),
            [
                'deviceUuid' => $deviceUuid
            ],
            true
        );
    }

}