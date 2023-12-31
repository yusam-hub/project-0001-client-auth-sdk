<?php

namespace YusamHub\Project0001ClientAuthSdk\Servers;

use Firebase\JWT\JWT;
use YusamHub\Project0001ClientAuthSdk\ClientAuthAppSdk;
use YusamHub\Project0001ClientAuthSdk\Exceptions\AuthRuntimeException;
use YusamHub\Project0001ClientAuthSdk\Exceptions\JsonAuthRuntimeException;
use YusamHub\Project0001ClientAuthSdk\Servers\Models\AppUserTokenAuthorizeModel;
use YusamHub\Project0001ClientAuthSdk\Tokens\JwtAuthAppUserTokenHelper;

class AppUserTokenServer extends BaseTokenServer
{
    protected ClientAuthAppSdk $clientAuthAppSdk;
    protected ?string $token;
    protected ?string $sign;
    protected ?string $content;

    /**
     * @param ClientAuthAppSdk $clientAuthAppSdk
     * @param string|null $token
     * @param string|null $sign
     * @param string|null $content
     */
    public function __construct(ClientAuthAppSdk $clientAuthAppSdk,
                                ?string $token,
                                ?string $sign,
                                ?string $content)
    {
        $this->clientAuthAppSdk = $clientAuthAppSdk;
        $this->token = $token;
        $this->sign = $sign;
        $this->content = $content;
    }

    protected function getApiAppUserKeyService(int $appUserKeyId, string $serviceKey): ?array
    {
        return $this->clientAuthAppSdk->getApiAppUserKeyService($appUserKeyId, $serviceKey);
    }

    protected function getApiAppUserKey(int $uid, string $did): ?array
    {
        return $this->clientAuthAppSdk->getApiAppUserKey($uid, $did);
    }

    /**
     * @return AppUserTokenAuthorizeModel
     * @throws \Throwable
     */
    public function getAuthorizeModelOrFail(): AppUserTokenAuthorizeModel
    {
        if (!empty($this->sign)) {

            $appUserKeyId = intval($this->token);
            $serviceKey = strval($this->sign);

            $appUserKeyService = $this->getApiAppUserKeyService($appUserKeyId, $serviceKey);

            if (is_null($appUserKeyService)) {
                throw new JsonAuthRuntimeException([
                    self::TOKEN_KEY_NAME => 'Invalid value',
                    self::SIGN_KEY_NAME => 'Invalid value',
                ]);
            }

            if (!isset($appUserKeyService['data']['appId'],$appUserKeyService['data']['userId'],$appUserKeyService['data']['deviceUuid'])) {
                throw new JsonAuthRuntimeException([
                    self::TOKEN_KEY_NAME => 'Invalid value',
                    self::SIGN_KEY_NAME => 'Invalid value',
                ]);
            }

            return (new AppUserTokenAuthorizeModel())->assign([
                'appId' => intval($appUserKeyService['data']['appId']),
                'userId' => intval($appUserKeyService['data']['userId']),
                'deviceUuid' => strval($appUserKeyService['data']['deviceUuid']),
            ]);
        }

        $serverTime = curl_ext_time_utc();
        JWT::$timestamp = $serverTime;

        $appUserHeads = JwtAuthAppUserTokenHelper::fromJwtAsHeads($this->token);

        if (is_null($appUserHeads->aid) || is_null($appUserHeads->uid) || is_null($appUserHeads->did)) {
            throw new AuthRuntimeException(self::AUTH_ERROR_MESSAGES[self::AUTH_ERROR_CODE_40101], self::AUTH_ERROR_CODE_40101);
        }

        $appUserKey = $this->getApiAppUserKey($appUserHeads->uid, $appUserHeads->did);

        if (!isset($appUserKey['data']['publicKey'])) {
            throw new AuthRuntimeException(self::AUTH_ERROR_MESSAGES[self::AUTH_ERROR_CODE_40102], self::AUTH_ERROR_CODE_40102);
        }

        $appUserTokenPayload = JwtAuthAppUserTokenHelper::fromJwtAsPayload($this->token, $appUserKey['data']['publicKey']);

        if (is_null($appUserTokenPayload->aid) || is_null($appUserTokenPayload->uid) || is_null($appUserTokenPayload->did) || is_null($appUserTokenPayload->iat) || is_null($appUserTokenPayload->exp) || is_null($appUserTokenPayload->hb)) {
            throw new AuthRuntimeException(self::AUTH_ERROR_MESSAGES[self::AUTH_ERROR_CODE_40103], self::AUTH_ERROR_CODE_40103);
        }

        if ($appUserTokenPayload->aid != $appUserHeads->aid || $appUserTokenPayload->uid != $appUserHeads->uid || $appUserTokenPayload->did != $appUserHeads->did) {
            throw new AuthRuntimeException(self::AUTH_ERROR_MESSAGES[self::AUTH_ERROR_CODE_40104], self::AUTH_ERROR_CODE_40104);
        }

        if ($serverTime < $appUserTokenPayload->iat and $serverTime > $appUserTokenPayload->exp) {
            throw new AuthRuntimeException(self::AUTH_ERROR_MESSAGES[self::AUTH_ERROR_CODE_40105], self::AUTH_ERROR_CODE_40105);
        }

        if (md5($this->content) !== $appUserTokenPayload->hb) {
            throw new AuthRuntimeException(self::AUTH_ERROR_MESSAGES[self::AUTH_ERROR_CODE_40106], self::AUTH_ERROR_CODE_40106);
        }

        return (new AppUserTokenAuthorizeModel())->assign([
            'appId' => $appUserTokenPayload->aid,
            'userId' => $appUserTokenPayload->uid,
            'deviceUuid' => $appUserTokenPayload->did,
        ]);
    }
}