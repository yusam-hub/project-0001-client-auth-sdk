<?php

namespace YusamHub\Project0001ClientAuthSdk\Servers;

use Firebase\JWT\JWT;
use YusamHub\Project0001ClientAuthSdk\ClientAuthAppSdk;
use YusamHub\Project0001ClientAuthSdk\Servers\Models\AppTokenAuthorizeModel;
use YusamHub\Project0001ClientAuthSdk\Servers\Models\AppUserTokenAuthorizeModel;
use YusamHub\Project0001ClientAuthSdk\Servers\Models\UserTokenAuthorizeModel;
use YusamHub\Project0001ClientAuthSdk\Tokens\JwtAuthAppTokenHelper;
use YusamHub\Project0001ClientAuthSdk\Tokens\JwtAuthAppUserTokenHelper;
use YusamHub\Project0001ClientAuthSdk\Tokens\JwtAuthUserTokenHelper;

class UserTokenServer extends BaseTokenServer
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

    protected function getUserId(int $userId, string $serviceKey): ?int
    {
        return null;
    }

    protected function getUserPublicKey(int $userId): ?string
    {
        return null;
    }

    /**
     * @return UserTokenAuthorizeModel
     * @throws \Throwable
     */
    public function getAuthorizeModelOrFail(): UserTokenAuthorizeModel
    {
        if (!empty($this->sign)) {

            $userId = intval($this->token);
            $serviceKey = strval($this->sign);

            $userId = $this->getUserId($userId, $serviceKey);

            if (is_null($userId)) {
                throw new \RuntimeException(json_encode([
                    self::TOKEN_KEY_NAME => 'Invalid value',
                    self::SIGN_KEY_NAME => 'Invalid value',
                ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            }

            return (new UserTokenAuthorizeModel())->assign([
                'userId' => $userId,
            ]);
        }

        $serverTime = curl_ext_time_utc();
        JWT::$timestamp = $serverTime;

        $userId = JwtAuthUserTokenHelper::getUserIdFromJwtHeads($this->token);

        if (is_null($userId)) {
            throw new \Exception(self::AUTH_ERROR_MESSAGES[self::AUTH_ERROR_CODE_40101], self::AUTH_ERROR_CODE_40101);
        }

        $publicKey = $this->getUserPublicKey($userId);

        if (is_null($publicKey)) {
            throw new \Exception(self::AUTH_ERROR_MESSAGES[self::AUTH_ERROR_CODE_40102], self::AUTH_ERROR_CODE_40102);
        }

        $userTokenPayload = JwtAuthUserTokenHelper::fromJwtAsPayload($this->token, $publicKey);

        if (is_null($userTokenPayload->uid) || is_null($userTokenPayload->iat) || is_null($userTokenPayload->exp) || is_null($userTokenPayload->hb)) {
            throw new \Exception(self::AUTH_ERROR_MESSAGES[self::AUTH_ERROR_CODE_40103], self::AUTH_ERROR_CODE_40103);
        }

        if ($userTokenPayload->uid != $userId) {
            throw new \Exception(self::AUTH_ERROR_MESSAGES[self::AUTH_ERROR_CODE_40104], self::AUTH_ERROR_CODE_40104);
        }

        if ($serverTime < $userTokenPayload->iat and $serverTime > $userTokenPayload->exp) {
            throw new \Exception(self::AUTH_ERROR_MESSAGES[self::AUTH_ERROR_CODE_40105], self::AUTH_ERROR_CODE_40105);
        }

        if (md5($this->content) !== $userTokenPayload->hb) {
            throw new \Exception(self::AUTH_ERROR_MESSAGES[self::AUTH_ERROR_CODE_40106], self::AUTH_ERROR_CODE_40106);
        }

        return (new UserTokenAuthorizeModel())->assign([
            'userId' => $userId,
        ]);
    }
}