<?php

namespace YusamHub\Project0001ClientAuthSdk\Tests;

use YusamHub\Project0001ClientAuthSdk\JwtHelper;

class ClientAuthSdkTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault()
    {
        $privateKey = file_get_contents(__DIR__ . '/../ssl/test-openssl-private-key.pem');
        $publicKey = file_get_contents(__DIR__ . '/../ssl/test-openssl-public-key.pem');

        $jwt = JwtHelper::toJwt('info@mail.ru', $privateKey, [
            'testPayloadKey' => 'testPayloadValue'
        ],
        [
            'testHeaderKey' => 'testHeaderValue'
        ]);
        var_dump($jwt);

        $payload = JwtHelper::fromJwtAsPayload($jwt, $publicKey);
        var_dump($payload);

        $headers = JwtHelper::fromJwtAsHeaders($jwt);
        var_dump($headers);

    }
}