<?php

namespace YusamHub\Project0001ClientAuthSdk\Servers;

use Firebase\JWT\JWT;
use YusamHub\Project0001ClientAuthSdk\Exceptions\AuthRuntimeException;
use YusamHub\Project0001ClientAuthSdk\Exceptions\JsonAuthRuntimeException;
use YusamHub\Project0001ClientAuthSdk\Servers\Models\AppTokenAuthorizeModel;
use YusamHub\Project0001ClientAuthSdk\Tokens\JwtAuthAppTokenHelper;

class AppTokenServer extends BaseTokenServer
{
    protected ?string $token;
    protected ?string $sign;
    protected ?string $content;

    /**
     * @param string|null $token
     * @param string|null $sign
     * @param string|null $content
     */
    public function __construct(?string $token,
                                ?string $sign,
                                ?string $content)
    {
        $this->token = $token;
        $this->sign = $sign;
        $this->content = $content;
    }

    protected function getAppId(int $appId, string $serviceKey): ?int
    {
        return null;
    }

    protected function getAppPublicKey(int $appId): ?string
    {
        return null;
    }

    /**
     * @return AppTokenAuthorizeModel
     * @throws \Throwable
     */
    public function getAuthorizeModelOrFail(): AppTokenAuthorizeModel
    {
        if (!empty($this->sign)) {

            $appId = intval($this->token);
            $serviceKey = strval($this->sign);

            $appId = $this->getAppId($appId, $serviceKey);

            if (is_null($appId)) {
                throw new JsonAuthRuntimeException([
                    self::TOKEN_KEY_NAME => 'Invalid value',
                    self::SIGN_KEY_NAME => 'Invalid value',
                ]);
            }

            return (new AppTokenAuthorizeModel())->assign([
                'appId' => $appId,
            ]);
        }

        $serverTime = curl_ext_time_utc();
        JWT::$timestamp = $serverTime;

        $appId = JwtAuthAppTokenHelper::getAppIdFromJwtHeads($this->token);

        if (is_null($appId)) {
            throw new AuthRuntimeException(self::AUTH_ERROR_MESSAGES[self::AUTH_ERROR_CODE_40101], self::AUTH_ERROR_CODE_40101);
        }

        $publicKey = $this->getAppPublicKey($appId);

        if (is_null($publicKey)) {
            throw new AuthRuntimeException(self::AUTH_ERROR_MESSAGES[self::AUTH_ERROR_CODE_40102], self::AUTH_ERROR_CODE_40102);
        }

        $appTokenPayload = JwtAuthAppTokenHelper::fromJwtAsPayload($this->token, $publicKey);

        if (is_null($appTokenPayload->aid) || is_null($appTokenPayload->iat) || is_null($appTokenPayload->exp) || is_null($appTokenPayload->hb)) {
            throw new AuthRuntimeException(self::AUTH_ERROR_MESSAGES[self::AUTH_ERROR_CODE_40103], self::AUTH_ERROR_CODE_40103);
        }

        if ($appTokenPayload->aid != $appId) {
            throw new AuthRuntimeException(self::AUTH_ERROR_MESSAGES[self::AUTH_ERROR_CODE_40104], self::AUTH_ERROR_CODE_40104);
        }

        if ($serverTime < $appTokenPayload->iat and $serverTime > $appTokenPayload->exp) {
            throw new AuthRuntimeException(self::AUTH_ERROR_MESSAGES[self::AUTH_ERROR_CODE_40105], self::AUTH_ERROR_CODE_40105);
        }

        if (md5($this->content) !== $appTokenPayload->hb) {
            throw new AuthRuntimeException(self::AUTH_ERROR_MESSAGES[self::AUTH_ERROR_CODE_40106], self::AUTH_ERROR_CODE_40106);
        }

        return (new AppTokenAuthorizeModel())->assign([
            'appId' => $appId,
        ]);
    }
}