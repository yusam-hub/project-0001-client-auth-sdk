<?php

namespace YusamHub\Project0001ClientAuthSdk;

class ClientAuthApiUserAppSdk extends BaseClientAuthApiAppSdk
{
    /**
     * @param int $appId
     * @return array|null
     */
    public function getAppIdKeyList(int $appId): ?array
    {
        return $this->doAppRequest(
            $this->api::METHOD_GET,
            strtr('/api/user/app/id/{appId}/key-list', [
                '{appId}' => $appId
            ]),
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