<?php

namespace YusamHub\Project0001ClientAuthSdk;

use YusamHub\Project0001ClientAuthSdk\Tokens\JwtAccessTokenHelper;
use YusamHub\Project0001ClientDemoSdk\Tokens\JwtDemoTokenHelper;

class ClientAuthApiUserSdk extends BaseClientUserTokenSdk
{
    /**
     * @param string $emailOrMobile
     * @return array|null
     */
    public function postAccountInitRegistration(string $emailOrMobile): ?array
    {
        return $this->doAppRequest(
            $this->api::METHOD_POST,
            '/api/user/account/init-registration',
            get_defined_vars()
        );
    }

    /**
     * @param string $emailOrMobile
     * @param string $hash
     * @param string $otp
     * @return array|null
     */
    public function postAccountConfirmRegistration(
        string $emailOrMobile,
        string $hash,
        string $otp
    ): ?array
    {
        return $this->doAppRequest(
            $this->api::METHOD_POST,
            '/api/user/account/confirm-registration',
            get_defined_vars()
        );
    }

    /**
     * @param string $emailOrMobile
     * @return array|null
     */
    public function postAccountInitRestoreRegistration(string $emailOrMobile): ?array
    {
        return $this->doAppRequest(
            $this->api::METHOD_POST,
            '/api/user/account/init-restore-registration',
            get_defined_vars()
        );
    }

    /**
     * @param string $emailOrMobile
     * @param string $hash
     * @param string $otp
     * @return array|null
     */
    public function postAccountConfirmRestoreRegistration(
        string $emailOrMobile,
        string $hash,
        string $otp
    ): ?array
    {
        return $this->doAppRequest(
            $this->api::METHOD_POST,
            '/api/user/account/confirm-restore-registration',
            get_defined_vars()
        );
    }

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

    /**
     * @param int $appId
     * @param string $deviceUuid
     * @param string $publicKeyHash
     * @param string $privateKey
     * @return array|null
     */
    public function postAppAccessToken(
        int $appId,
        string $deviceUuid,
        string $publicKeyHash,
        string $privateKey
    ): ?array
    {
        return $this->doAppRequest(
            $this->api::METHOD_POST,
            '/api/user/app/access-token',
            [
                'assertion' => JwtAccessTokenHelper::toJwt(
                    $appId,
                    $this->identifierId,
                    $deviceUuid,
                    $publicKeyHash,
                    $privateKey
                ),
            ],
            true
        );
    }
}