<?php

namespace YusamHub\Project0001ClientAuthSdk;

use YusamHub\Project0001ClientAuthSdk\Tokens\JwtAccessTokenHelper;

class ClientAuthUserSdk extends BaseClientUserTokenSdk
{
    /**
     * @param string $emailOrMobile
     * @return array|null
     */
    public function postApiUserAccountInitRegistration(string $emailOrMobile): ?array
    {
        return $this->doBaseRequest(
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
    public function postApiUserAccountConfirmRegistration(
        string $emailOrMobile,
        string $hash,
        string $otp
    ): ?array
    {
        return $this->doBaseRequest(
            $this->api::METHOD_POST,
            '/api/user/account/confirm-registration',
            get_defined_vars()
        );
    }

    /**
     * @param string $emailOrMobile
     * @return array|null
     */
    public function postApiUserAccountInitRestoreRegistration(string $emailOrMobile): ?array
    {
        return $this->doBaseRequest(
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
    public function postApiUserAccountConfirmRestoreRegistration(
        string $emailOrMobile,
        string $hash,
        string $otp
    ): ?array
    {
        return $this->doBaseRequest(
            $this->api::METHOD_POST,
            '/api/user/account/confirm-restore-registration',
            get_defined_vars()
        );
    }

    /**
     * @param int $appId
     * @return array|null
     */
    public function getApiUserAppIdKeyList(int $appId): ?array
    {
        return $this->doBaseRequest(
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
    public function postApiUserAppIdKeyRefresh(int $appId, string $deviceUuid): ?array
    {
        return $this->doBaseRequest(
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
    public function postApiUserAppAccessToken(
        int $appId,
        string $deviceUuid,
        string $publicKeyHash,
        string $privateKey
    ): ?array
    {
        return $this->doBaseRequest(
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