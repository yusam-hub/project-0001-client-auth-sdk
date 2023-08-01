<?php

namespace YusamHub\Project0001ClientAuthSdk\Tests;

use YusamHub\Project0001ClientAuthSdk\JwtAuthHelper;

class ClientAuthSdkTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault()
    {
        $privateKey = file_get_contents(__DIR__ . '/../ssl/test-openssl-private-key.pem');
        $publicKey = file_get_contents(__DIR__ . '/../ssl/test-openssl-public-key.pem');

        $jwt = JwtAuthHelper::toJwt(
            1,
            1,
            'test-device',
            $privateKey,
            [
                'testPayloadKey' => 'testPayloadValue'
            ],
        [
            'testHeaderKey' => 'testHeaderValue'
        ]);
        var_dump($jwt);

        $payload = JwtAuthHelper::fromJwtAsPayload($jwt, $publicKey);
        var_dump($payload);

        $headers = JwtAuthHelper::fromJwtAsHeaders($jwt);
        var_dump($headers);

    }
}