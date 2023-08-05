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

    /*public function testPostAppAdd()
    {
        $clientAuthApiFrontAppSdk = new ClientAuthApiFrontAppSdk(Config::getConfig('testing'));
        $appAdd = $clientAuthApiFrontAppSdk->postAppAdd('My test app');
        $this->assertTrue(is_array($appAdd));
    }*/

    /*public function testGetAppList()
    {
        $clientAuthApiFrontAppSdk = new ClientAuthApiFrontAppSdk(Config::getConfig('testing'));
        $appList = $clientAuthApiFrontAppSdk->getAppList();
        $this->assertTrue(is_array($appList));
    }*/

    /*public function testGetAppId()
    {
        $clientAuthApiFrontAppSdk = new ClientAuthApiFrontAppSdk(Config::getConfig('testing'));
        $app = $clientAuthApiFrontAppSdk->getAppId(2);
        $this->assertTrue(is_array($app));
    }*/

    /*public function testPutAppIdChangeTitle()
    {
        $clientAuthApiFrontAppSdk = new ClientAuthApiFrontAppSdk(Config::getConfig('testing'));
        $app = $clientAuthApiFrontAppSdk->putAppIdChangeTitle(2, 'My test changed title');
        $this->assertTrue(is_array($app));
    }*/

    /*public function testPutAppIdChangeKeys()
    {
        $clientAuthApiFrontAppSdk = new ClientAuthApiFrontAppSdk(Config::getConfig('testing'));
        $app = $clientAuthApiFrontAppSdk->putAppIdChangeKeys(2);
        $this->assertTrue(is_array($app));
    }*/
}