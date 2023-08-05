<?php

namespace YusamHub\Project0001ClientAuthSdk\Tokens;

use YusamHub\Project0001ClientAuthSdk\Heads\AppUserTokenHead;
use YusamHub\Project0001ClientAuthSdk\Payloads\AppUserTokenPayload;

class JwtAuthAppUserTokenHelper extends JwtBaseTokenHelper
{
    /**
     * @param int $userId
     * @param int $appId
     * @param string $deviceUuid
     * @param string $privateKey
     * @param int $expireSeconds
     * @param int $skewSeconds
     * @return string
     */
    public static function toJwt(
        int $userId,
        int $appId,
        string $deviceUuid,
        string $privateKey,
        int $expireSeconds = 3600,
        int $skewSeconds = 60,
    ): string
    {
        $now = time();

        $appUserTokenPayload = new AppUserTokenPayload();
        $appUserTokenPayload->uid = $userId;
        $appUserTokenPayload->aid = $appId;
        $appUserTokenPayload->did = $deviceUuid;
        $appUserTokenPayload->iat = ($now - $skewSeconds);
        $appUserTokenPayload->exp = ($now + $expireSeconds);

        return static::baseToJwt(
            $appUserTokenPayload,
            $privateKey,
            'RS256',
            (array) (new AppUserTokenHead([
                'uid' => $appUserTokenPayload->uid,
                'aid' => $appUserTokenPayload->aid,
                'did' => $appUserTokenPayload->did,
            ]))
        );
    }

    /**
     * @param string $jwt
     * @return AppUserTokenHead
     */
    public static function fromJwtAsHeads(string $jwt): AppUserTokenHead
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
}