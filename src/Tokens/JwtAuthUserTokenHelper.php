<?php

namespace YusamHub\Project0001ClientAuthSdk\Tokens;

use Firebase\JWT\JWT;
use YusamHub\Project0001ClientAuthSdk\Heads\UserTokenHead;
use YusamHub\Project0001ClientAuthSdk\Payloads\UserTokenPayload;

class JwtAuthUserTokenHelper extends JwtBaseTokenHelper
{
    /**
     * @param int $userId
     * @param string $privateKey
     * @param string $hashBody
     * @param int $expireSeconds
     * @param int $skewSeconds
     * @return string
     */
    public static function toJwt(
        int $userId,
        string $privateKey,
        string $hashBody,
        int $expireSeconds = 60,
        int $skewSeconds = 30,
    ): string
    {
        $now = curl_ext_time_utc();
        JWT::$timestamp = $now;

        $userTokenPayload = new UserTokenPayload();
        $userTokenPayload->uid = $userId;
        $userTokenPayload->iat = ($now - $skewSeconds);
        $userTokenPayload->exp = ($now + $expireSeconds);
        $userTokenPayload->hb = $hashBody;

        return static::baseToJwt(
            $userTokenPayload,
            $privateKey,
            'RS256',
            (array) (new UserTokenHead([
                'uid' => $userTokenPayload->uid,
            ]))
        );
    }

    /**
     * @param string $jwt
     * @return UserTokenHead
     */
    protected static function fromJwtAsHeads(string $jwt): UserTokenHead
    {
        return new UserTokenHead(static::baseFromJwtAsHeads($jwt));
    }

    /**
     * @param string $jwt
     * @param string $publicKey
     * @return UserTokenPayload
     */
    public static function fromJwtAsPayload(string $jwt, string $publicKey): UserTokenPayload
    {
        return new UserTokenPayload(static::baseFromJwtAsPayload($jwt, $publicKey));
    }

    /**
     * @param string $jwt
     * @return int|null
     */
    public static function getUserIdFromJwtHeads(string $jwt): ?int
    {
        $userTokenHead = static::fromJwtAsHeads($jwt);
        return $userTokenHead->uid;
    }
}