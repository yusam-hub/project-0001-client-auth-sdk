<?php

namespace YusamHub\Project0001ClientAuthSdk\Tests;

use YusamHub\Project0001ClientAuthSdk\ClientAuthAdminSdk;
use YusamHub\Project0001ClientAuthSdk\ClientAuthAppSdk;
use YusamHub\Project0001ClientAuthSdk\ClientAuthUserSdk;
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
        $clientAuthAdminAppSdk = new ClientAuthAdminSdk(Config::getConfig('user-sdk'));
        $appAdd = $clientAuthAdminAppSdk->postAppAdd('My test app');
        $this->assertTrue(is_array($appAdd));
    }*/

    /*public function testGetAppList()
    {
        $clientAuthAdminAppSdk = new ClientAuthAdminSdk(Config::getConfig('user-sdk'));
        $appList = $clientAuthAdminAppSdk->getAppList();
        $this->assertTrue(is_array($appList));
    }*/

    /*public function testGetAppId()
    {
        $clientAuthAdminAppSdk = new ClientAuthAdminSdk(Config::getConfig('user-sdk'));
        $app = $clientAuthAdminAppSdk->getAppId(2);
        $this->assertTrue(is_array($app));
    }*/

    /*public function testPutAppIdChangeTitle()
    {
        $clientAuthAdminAppSdk = new ClientAuthAdminSdk(Config::getConfig('user-sdk'));
        $app = $clientAuthAdminAppSdk->putAppIdChangeTitle(2, 'My test changed title');
        $this->assertTrue(is_array($app));
    }*/

    /*public function testPutAppIdChangeKeys()
    {
        $clientAuthAdminAppSdk = new ClientAuthAdminSdk(Config::getConfig('user-sdk'));
        $app = $clientAuthAdminAppSdk->putAppIdChangeKeys(2);
        $this->assertTrue(is_array($app));
    }*/

    /*public function testPostAppIdRefresh()
    {
        $clientAuthUserAppSdk = new ClientAuthUserSdk(Config::getConfig('user-sdk'));
        $appIdRefresh = $clientAuthUserAppSdk->postAppIdRefresh(2,'12345678901234567890123456789012');
        $this->assertTrue(is_array($appIdRefresh));

        $accessToken = $clientAuthUserAppSdk->postAppAccessToken(
            2,
            '12345678901234567890123456789012',
            $appIdRefresh['data']['keyHash'],
            $appIdRefresh['data']['privateKey'],
        );
        $this->assertTrue(is_array($accessToken));
        var_dump($accessToken);
    }*/

    /*public function testGetAppKeyList()
    {
        $clientAuthUserAppSdk = new ClientAuthUserSdk(Config::getConfig('user-sdk'));
        $appKeyList = $clientAuthUserAppSdk->getAppKeyList();
        $this->assertTrue(is_array($appKeyList));
    }*/

    /*public function testGetAppUserKey()
    {
        $clientAuthAppSdk = new ClientAuthAppSdk(Config::getConfig('app-sdk'));
        $accessToken = $clientAuthAppSdk->getAccessToken('0f37370a3a6fb7140d170b797d81fda2');
        $this->assertTrue(is_array($accessToken));
    }*/

}