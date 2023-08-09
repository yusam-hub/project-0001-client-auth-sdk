<?php

namespace YusamHub\Project0001ClientAuthSdk\Tokens;

use YusamHub\Project0001ClientAuthSdk\Heads\AppTokenHead;
use YusamHub\Project0001ClientAuthSdk\Payloads\AppTokenPayload;

class JwtAuthAppTokenHelper extends JwtBaseTokenHelper
{
    /**
     * @param int $appId
     * @param string $privateKey
     * @param string $hashBody
     * @param int $expireSeconds
     * @param int $skewSeconds
     * @return string
     */
    public static function toJwt(
        int $appId,
        string $privateKey,
        string $hashBody,
        int $expireSeconds = 30,
        int $skewSeconds = 30,
    ): string
    {
        $now = curl_ext_time_utc();

        $appTokenPayload = new AppTokenPayload();
        $appTokenPayload->aid = $appId;
        $appTokenPayload->iat = ($now - $skewSeconds);
        $appTokenPayload->exp = ($now + $expireSeconds);
        $appTokenPayload->hb = $hashBody;

        return static::baseToJwt(
            $appTokenPayload,
            $privateKey,
            'RS256',
            (array) (new AppTokenHead([
                'aid' => $appTokenPayload->aid,
            ]))
        );
    }

    /**
     * @param string $jwt
     * @return AppTokenHead
     */
    protected static function fromJwtAsHeads(string $jwt): AppTokenHead
    {
        return new AppTokenHead(static::baseFromJwtAsHeads($jwt));
    }

    /**
     * @param string $jwt
     * @param string $publicKey
     * @return AppTokenPayload
     */
    public static function fromJwtAsPayload(string $jwt, string $publicKey): AppTokenPayload
    {
        return new AppTokenPayload(static::baseFromJwtAsPayload($jwt, $publicKey));
    }

    /**
     * @param string $jwt
     * @return int|null
     */
    public static function getAppFromJwtHeads(string $jwt): ?int
    {
        $appTokenHead = static::fromJwtAsHeads($jwt);
        return $appTokenHead->aid;
    }
}