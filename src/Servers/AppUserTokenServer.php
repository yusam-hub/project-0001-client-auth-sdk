<?php

namespace YusamHub\Project0001ClientAuthSdk\Servers;

use Firebase\JWT\JWT;
use YusamHub\Project0001ClientAuthSdk\ClientAuthAppSdk;
use YusamHub\Project0001ClientAuthSdk\Servers\Models\AppUserTokenAuthorizeModel;
use YusamHub\Project0001ClientAuthSdk\Tokens\JwtAuthAppUserTokenHelper;

class AppUserTokenServer extends BaseTokenServer
{
    protected ClientAuthAppSdk $clientAuthAppSdk;
    protected ?string $token;
    protected ?string $sign;
    protected ?string $content;

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

    public function getAuthorizeModelOrFail(): AppUserTokenAuthorizeModel
    {
        try {

            if (!empty($this->sign)) {

                $appUserKeyId = intval($this->token);
                $serviceKey = $this->sign;

                //todo: need cache $appUserKeyId + $serviceKey на 600 секунд (что бы каждый раз не дергать апи авторизации)
                $appUserKeyService = $this->clientAuthAppSdk->getApiAppUserKeyService($appUserKeyId, $serviceKey);

                if (is_null($appUserKeyService)) {
                    throw new \RuntimeException(json_encode([
                        self::TOKEN_KEY_NAME => 'Invalid value',
                        self::SIGN_KEY_NAME => 'Invalid value',
                    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
                }

                if (!isset($appUserKeyService['data']['appId'],$appUserKeyService['data']['userId'],$appUserKeyService['data']['deviceUuid'])) {
                    throw new \RuntimeException(json_encode([
                        self::TOKEN_KEY_NAME => 'Invalid value',
                        self::SIGN_KEY_NAME => 'Invalid value',
                    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
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
                throw new \Exception(self::AUTH_ERROR_MESSAGES[self::AUTH_ERROR_CODE_40101], self::AUTH_ERROR_CODE_40101);
            }

            //todo: need cache $appUserKey['publicKey'], при это hashKey должен быть в токене передан

            $appUserKey = $this->clientAuthAppSdk->getApiAppUserKey($appUserHeads->uid, $appUserHeads->did);

            if (!isset($appUserKey['publicKey'])) {
                throw new \Exception(self::AUTH_ERROR_MESSAGES[self::AUTH_ERROR_CODE_40102], self::AUTH_ERROR_CODE_40102);
            }

            $appUserTokenPayload = JwtAuthAppUserTokenHelper::fromJwtAsPayload($this->token, $appUserKey['publicKey']);

            if (is_null($appUserTokenPayload->aid) || is_null($appUserTokenPayload->uid) || is_null($appUserTokenPayload->did) || is_null($appUserTokenPayload->iat) || is_null($appUserTokenPayload->exp) || is_null($appUserTokenPayload->hb)) {
                throw new \Exception(self::AUTH_ERROR_MESSAGES[self::AUTH_ERROR_CODE_40103], self::AUTH_ERROR_CODE_40103);
            }

            if ($appUserTokenPayload->aid != $appUserHeads->aid || $appUserTokenPayload->uid != $appUserHeads->uid || $appUserTokenPayload->did != $appUserHeads->did) {
                throw new \Exception(self::AUTH_ERROR_MESSAGES[self::AUTH_ERROR_CODE_40104], self::AUTH_ERROR_CODE_40104);
            }

            if ($serverTime < $appUserTokenPayload->iat and $serverTime > $appUserTokenPayload->exp) {
                throw new \Exception(self::AUTH_ERROR_MESSAGES[self::AUTH_ERROR_CODE_40105], self::AUTH_ERROR_CODE_40105);
            }

            if (md5($this->content) !== $appUserTokenPayload->hb) {
                throw new \Exception(self::AUTH_ERROR_MESSAGES[self::AUTH_ERROR_CODE_40106], self::AUTH_ERROR_CODE_40106);
            }

            return (new AppUserTokenAuthorizeModel())->assign([
                'appId' => $appUserTokenPayload->aid,
                'userId' => $appUserTokenPayload->uid,
                'deviceUuid' => $appUserTokenPayload->did,
            ]);

        } catch (\Throwable $e) {

            throw $e;

        }
    }
}