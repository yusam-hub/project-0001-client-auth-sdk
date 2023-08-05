<?php

namespace YusamHub\Project0001ClientAuthSdk;

class ClientAuthApiAdminAppSdk extends BaseClientAuthApiAppSdk
{
    /**
     * @return array|null
     */
    public function getAppList(): ?array
    {
        return $this->doAppRequest(
            $this->api::METHOD_GET,
            '/api/admin/app/list',
            [],
            true
        );
    }

    /**
     * @param string $title
     * @return array|null
     */
    public function postAppAdd(string $title): ?array
    {
        return $this->doAppRequest(
            $this->api::METHOD_POST,
            '/api/admin/app/add',
            get_defined_vars(),
            true
        );
    }

    /**
     * @param int $appId
     * @return array|null
     */
    public function getAppId(int $appId): ?array
    {
        return $this->doAppRequest(
            $this->api::METHOD_GET,
            strtr('/api/admin/app/id/{appId}',[
                '{appId}' => $appId
            ]),
            [],
            true
        );
    }

    /**
     * @param int $appId
     * @param string $title
     * @return array|null
     */
    public function putAppIdChangeTitle(int $appId, string $title): ?array
    {
        return $this->doAppRequest(
            $this->api::METHOD_PUT,
            strtr('/api/admin/app/id/{appId}/change-title',[
                '{appId}' => $appId
            ]),
            [
                'title' => $title
            ],
            true
        );
    }

    /**
     * @param int $appId
     * @return array|null
     */
    public function putAppIdChangeKeys(int $appId): ?array
    {
        return $this->doAppRequest(
            $this->api::METHOD_PUT,
            strtr('/api/admin/app/id/{appId}/change-keys',[
                '{appId}' => $appId
            ]),
            [
            ],
            true
        );
    }
}