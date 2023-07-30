<?php

namespace YusamHub\Project0001ClientAuthSdk;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtHelper
{
    /**
     * @param string $clientId
     * @param string $privateKey
     * @param array $payload
     * @param array $headers
     * @param int $expireSeconds
     * @param int $skewSeconds
     * @return string
     */
    public static function toJwt(
        string $clientId,
        string $privateKey,
        array $payload = [],
        array $headers = [],
        int $expireSeconds = 3600,
        int $skewSeconds = 60,
    ): string
    {
        $now = time();

        $tmpPayload = array_merge([
            'iss' => null,
            'exp' => null,
            'iat' => null,
        ], $payload);

        $tmpPayload['iss'] = $clientId;
        $tmpPayload['exp'] = ($now + $expireSeconds);
        $tmpPayload['iat'] = ($now - $skewSeconds);

        return JWT::encode(
            $tmpPayload,
            $privateKey,
            'RS256',
            null,
            $headers
        );
    }

    /**
     * @param string $jwt
     * @param string $publicKey
     * @return array
     */
    public static function fromJwtAsPayload(string $jwt, string $publicKey): array
    {
        return (array) JWT::decode($jwt, new Key($publicKey, 'RS256'));
    }

    /**
     * @param string $jwt
     * @return array
     */
    public static function fromJwtAsHeaders(string $jwt): array
    {
        list($headersB64, $payloadB64, $sig) = explode('.', $jwt);
        return (array) json_decode(base64_decode($headersB64), true);
    }
}