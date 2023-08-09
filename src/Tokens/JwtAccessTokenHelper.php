<?php

namespace YusamHub\Project0001ClientAuthSdk\Tokens;

use YusamHub\Project0001ClientAuthSdk\Heads\AccessTokenHead;
use YusamHub\Project0001ClientAuthSdk\Payloads\AccessTokenPayload;

class JwtAccessTokenHelper extends JwtBaseTokenHelper
{
    /**
     * @param int $appId
     * @param int $userId
     * @param string $deviceUuid
     * @param string $publicKeyHash
     * @param string $privateKey
     * @param int $expireSeconds
     * @param int $skewSeconds
     * @return string
     */
    public static function toJwt(
        int $appId,
        int $userId,
        string $deviceUuid,
        string $publicKeyHash,
        string $privateKey,
        int $expireSeconds = 3600,
        int $skewSeconds = 60,
    ): string
    {
        $now = time();//todo: convert to UTC

        $accessTokenPayload = new AccessTokenPayload();
        $accessTokenPayload->aid = $appId;
        $accessTokenPayload->uid = $userId;
        $accessTokenPayload->did = $deviceUuid;
        $accessTokenPayload->pkh = $publicKeyHash;
        $accessTokenPayload->iat = ($now - $skewSeconds);
        $accessTokenPayload->exp = ($now + $expireSeconds);

        return static::baseToJwt(
            $accessTokenPayload,
            $privateKey,
            'RS256',
            (array) (new AccessTokenHead([
                'aid' => $accessTokenPayload->aid,
                'uid' => $accessTokenPayload->uid,
                'did' => $accessTokenPayload->did,
            ]))
        );
    }

    /**
     * @param string $jwt
     * @return AccessTokenHead
     */
    public static function fromJwtAsHeads(string $jwt): AccessTokenHead
    {
        return new AccessTokenHead(static::baseFromJwtAsHeads($jwt));
    }

    /**
     * @param string $jwt
     * @param string $publicKey
     * @return AccessTokenPayload
     */
    public static function fromJwtAsPayload(string $jwt, string $publicKey): AccessTokenPayload
    {
        return new AccessTokenPayload(static::baseFromJwtAsPayload($jwt, $publicKey));
    }
}