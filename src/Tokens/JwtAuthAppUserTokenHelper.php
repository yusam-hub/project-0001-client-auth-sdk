<?php

namespace YusamHub\Project0001ClientAuthSdk\Tokens;

use Firebase\JWT\JWT;
use YusamHub\Project0001ClientAuthSdk\Heads\AppUserTokenHead;
use YusamHub\Project0001ClientAuthSdk\Payloads\AppUserTokenPayload;

class JwtAuthAppUserTokenHelper extends JwtBaseTokenHelper
{
    /**
     * @param int $appId
     * @param int $userId
     * @param string $deviceUuid
     * @param string $privateKey
     * @param string $hashBody
     * @param int $expireSeconds
     * @param int $skewSeconds
     * @return string
     */
    public static function toJwt(
        int $appId,
        int $userId,
        string $deviceUuid,
        string $privateKey,
        string $hashBody,
        int $expireSeconds = 60,
        int $skewSeconds = 30,
    ): string
    {
        $now = curl_ext_time_utc();
        JWT::$timestamp = $now;

        $appUserTokenPayload = new AppUserTokenPayload();
        $appUserTokenPayload->aid = $appId;
        $appUserTokenPayload->uid = $userId;
        $appUserTokenPayload->did = $deviceUuid;
        $appUserTokenPayload->iat = ($now - $skewSeconds);
        $appUserTokenPayload->exp = ($now + $expireSeconds);
        $appUserTokenPayload->hb = $hashBody;

        return static::baseToJwt(
            $appUserTokenPayload,
            $privateKey,
            'RS256',
            (array) (new AppUserTokenHead([
                'aid' => $appUserTokenPayload->aid,
                'uid' => $appUserTokenPayload->uid,
                'did' => $appUserTokenPayload->did,
            ]))
        );
    }

    /**
     * @param string $jwt
     * @return AppUserTokenHead
     */
    protected static function fromJwtAsHeads(string $jwt): AppUserTokenHead
    {
        return new AppUserTokenHead(static::baseFromJwtAsHeads($jwt));
    }

    /**
     * @param string $jwt
     * @param string $publicKey
     * @return AppUserTokenPayload
     */
    public static function fromJwtAsPayload(string $jwt, string $publicKey): AppUserTokenPayload
    {
        return new AppUserTokenPayload(static::baseFromJwtAsPayload($jwt, $publicKey));
    }

    /**
     * @param string $jwt
     * @return int|null
     */
    public static function getAppIdFromJwtHeads(string $jwt): ?int
    {
        $appUserTokenHead = static::fromJwtAsHeads($jwt);
        return $appUserTokenHead->aid;
    }

    /**
     * @param string $jwt
     * @return int|null
     */
    public static function getUserIdFromJwtHeads(string $jwt): ?int
    {
        $appUserTokenHead = static::fromJwtAsHeads($jwt);
        return $appUserTokenHead->uid;
    }

    /**
     * @param string $jwt
     * @return string|null
     */
    public static function getDeviceUuidFromJwtHeads(string $jwt): ?string
    {
        $appUserTokenHead = static::fromJwtAsHeads($jwt);
        return $appUserTokenHead->did;
    }
}