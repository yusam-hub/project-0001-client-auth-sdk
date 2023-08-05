<?php

namespace YusamHub\Project0001ClientAuthSdk;

class ClientAuthApiUserAccountSdk extends BaseClientAuthApiAppSdk
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

}