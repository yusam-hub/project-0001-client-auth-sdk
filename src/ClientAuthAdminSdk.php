<?php

namespace YusamHub\Project0001ClientAuthSdk;

class ClientAuthAdminSdk extends BaseClientUserTokenSdk
{
    /**
     * @return array|null
     */
    public function getApiAdminAppList(): ?array
    {
        return $this->doBaseRequest(
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
    public function postApiAdminAppAdd(string $title): ?array
    {
        return $this->doBaseRequest(
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
    public function getApiAdminAppId(int $appId): ?array
    {
        return $this->doBaseRequest(
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
    public function putApiAdminAppIdChangeTitle(int $appId, string $title): ?array
    {
        return $this->doBaseRequest(
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
    public function putApiAdminAppIdChangeKeys(int $appId): ?array
    {
        return $this->doBaseRequest(
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