<?php

namespace YusamHub\Project0001ClientAuthSdk\Tokens;

use YusamHub\Project0001ClientAuthSdk\Heads\UserTokenHead;
use YusamHub\Project0001ClientAuthSdk\Payloads\UserTokenPayload;

class JwtAuthUserTokenHelper extends JwtBaseTokenHelper
{
    /**
     * @param string $userId
     * @param string $privateKey
     * @param string $hashBody
     * @param int $expireSeconds
     * @param int $skewSeconds
     * @return string
     */
    public static function toJwt(
        string $userId,
        string $privateKey,
        string $hashBody,
        int $expireSeconds = 30,
        int $skewSeconds = 30,
    ): string
    {
        $now = time();

        $userTokenPayload = new UserTokenPayload();
        $userTokenPayload->uid = $userId;
        $userTokenPayload->iat = ($now - $skewSeconds);
        $userTokenPayload->exp = ($now + $expireSeconds);
        $userTokenPayload->hb = $hashBody;

        return static::baseToJwt(
            $userTokenPayload,
            $privateKey,
            'RS256',
            [
                'uid' => $userTokenPayload->uid,
            ]
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
    public static function getUserFromJwtHeads(string $jwt): ?int
    {
        $userTokenHead = static::fromJwtAsHeads($jwt);
        return $userTokenHead->uid;
    }
}