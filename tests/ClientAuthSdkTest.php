<?php

namespace YusamHub\Project0001ClientAuthSdk\Tests;

use YusamHub\Project0001ClientAuthSdk\ClientAuthApiFrontAppSdk;
use YusamHub\Project0001ClientAuthSdk\Tokens\JwtAuthUserTokenHelper;

class ClientAuthSdkTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault()
    {
        /*$privateKey = file_get_contents(__DIR__ . '/../ssl/test-openssl-private-key.pem');
        $publicKey = file_get_contents(__DIR__ . '/../ssl/test-openssl-public-key.pem');

        $userId = 1;
        $jwt = JwtAuthUserTokenHelper::toJwt(
            $userId,
            md5('test'),
            $privateKey
        );
        var_dump($jwt);

        $payload = JwtAuthUserTokenHelper::fromJwtAsPayload($jwt, $publicKey);
        var_dump((array) $payload);

        $userId = JwtAuthUserTokenHelper::getUserFromJwtHeads($jwt);
        var_dump($userId);*/
        $this->assertTrue(true);
    }

    public function testPostAppAdd()
    {
        $clientAuthApiFrontAppSdk = new ClientAuthApiFrontAppSdk(Config::getConfig('testing'));
        $appAdd = $clientAuthApiFrontAppSdk->postAppAdd('My test app');
        $this->assertTrue(is_array($appAdd));
    }

    public function testGetAppList()
    {
        $clientAuthApiFrontAppSdk = new ClientAuthApiFrontAppSdk(Config::getConfig('testing'));
        $appList = $clientAuthApiFrontAppSdk->getAppList();
        $this->assertTrue(is_array($appList));
    }
}