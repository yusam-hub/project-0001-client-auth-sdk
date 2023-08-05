<?php

namespace YusamHub\Project0001ClientAuthSdk\Tests;

use YusamHub\Project0001ClientAuthSdk\ClientAuthApiAdminSdk;
use YusamHub\Project0001ClientAuthSdk\ClientAuthApiUserAppSdk;
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
        $clientAuthApiAdminAppSdk = new ClientAuthApiAdminAppSdk(Config::getConfig('user-token-testing'));
        $appAdd = $clientAuthApiAdminAppSdk->postAppAdd('My test app');
        $this->assertTrue(is_array($appAdd));
    }*/

    /*public function testGetAppList()
    {
        $clientAuthApiAdminAppSdk = new ClientAuthApiAdminAppSdk(Config::getConfig('user-token-testing'));
        $appList = $clientAuthApiAdminAppSdk->getAppList();
        $this->assertTrue(is_array($appList));
    }*/

    /*public function testGetAppId()
    {
        $clientAuthApiAdminAppSdk = new ClientAuthApiAdminAppSdk(Config::getConfig('user-token-testing'));
        $app = $clientAuthApiAdminAppSdk->getAppId(2);
        $this->assertTrue(is_array($app));
    }*/

    /*public function testPutAppIdChangeTitle()
    {
        $clientAuthApiAdminAppSdk = new ClientAuthApiAdminAppSdk(Config::getConfig('user-token-testing'));
        $app = $clientAuthApiAdminAppSdk->putAppIdChangeTitle(2, 'My test changed title');
        $this->assertTrue(is_array($app));
    }*/

    /*public function testPutAppIdChangeKeys()
    {
        $clientAuthApiAdminAppSdk = new ClientAuthApiAdminAppSdk(Config::getConfig('user-token-testing'));
        $app = $clientAuthApiAdminAppSdk->putAppIdChangeKeys(2);
        $this->assertTrue(is_array($app));
    }*/

    /*public function testPostAppIdRefresh()
    {
        $clientAuthApiUserAppSdk = new ClientAuthApiUserAppSdk(Config::getConfig('user-token-testing'));
        $appIdRefresh = $clientAuthApiUserAppSdk->postAppIdRefresh(2,'12345678901234567890123456789012');
        $this->assertTrue(is_array($appIdRefresh));
    }*/

    /*public function testGetAppKeyList()
    {
        $clientAuthApiUserAppSdk = new ClientAuthApiUserAppSdk(Config::getConfig('user-token-testing'));
        $appKeyList = $clientAuthApiUserAppSdk->getAppKeyList();
        $this->assertTrue(is_array($appKeyList));
    }*/
}