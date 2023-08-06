<?php

namespace YusamHub\Project0001ClientAuthSdk\Tests;

use YusamHub\Project0001ClientAuthSdk\ClientAuthApiAdminSdk;
use YusamHub\Project0001ClientAuthSdk\ClientAuthApiAppSdk;
use YusamHub\Project0001ClientAuthSdk\ClientAuthApiUserSdk;
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
        $clientAuthApiAdminAppSdk = new ClientAuthApiAdminSdk(Config::getConfig('user-sdk'));
        $appAdd = $clientAuthApiAdminAppSdk->postAppAdd('My test app');
        $this->assertTrue(is_array($appAdd));
    }*/

    /*public function testGetAppList()
    {
        $clientAuthApiAdminAppSdk = new ClientAuthApiAdminSdk(Config::getConfig('user-sdk'));
        $appList = $clientAuthApiAdminAppSdk->getAppList();
        $this->assertTrue(is_array($appList));
    }*/

    /*public function testGetAppId()
    {
        $clientAuthApiAdminAppSdk = new ClientAuthApiAdminSdk(Config::getConfig('user-sdk'));
        $app = $clientAuthApiAdminAppSdk->getAppId(2);
        $this->assertTrue(is_array($app));
    }*/

    /*public function testPutAppIdChangeTitle()
    {
        $clientAuthApiAdminAppSdk = new ClientAuthApiAdminSdk(Config::getConfig('user-sdk'));
        $app = $clientAuthApiAdminAppSdk->putAppIdChangeTitle(2, 'My test changed title');
        $this->assertTrue(is_array($app));
    }*/

    /*public function testPutAppIdChangeKeys()
    {
        $clientAuthApiAdminAppSdk = new ClientAuthApiAdminSdk(Config::getConfig('user-sdk'));
        $app = $clientAuthApiAdminAppSdk->putAppIdChangeKeys(2);
        $this->assertTrue(is_array($app));
    }*/

    public function testPostAppIdRefresh()
    {
        $clientAuthApiUserAppSdk = new ClientAuthApiUserSdk(Config::getConfig('user-sdk'));
        $appIdRefresh = $clientAuthApiUserAppSdk->postAppIdRefresh(2,'12345678901234567890123456789012');
        $this->assertTrue(is_array($appIdRefresh));

        $accessToken = $clientAuthApiUserAppSdk->postAppAccessToken(
            2,
            '12345678901234567890123456789012',
            $appIdRefresh['data']['keyHash'],
            $appIdRefresh['data']['privateKey'],
        );

        var_dump($accessToken);
    }

    /*public function testGetAppKeyList()
    {
        $clientAuthApiUserAppSdk = new ClientAuthApiUserSdk(Config::getConfig('user-sdk'));
        $appKeyList = $clientAuthApiUserAppSdk->getAppKeyList();
        $this->assertTrue(is_array($appKeyList));
    }*/

    /*public function testGetAppUserKey()
    {
        $clientAuthApiAppSdk = new ClientAuthApiAppSdk(Config::getConfig('app-sdk'));
        $userKey = $clientAuthApiAppSdk->getUserKey(
            2,
            '12345678901234567890123456789012'
        );
        $this->assertTrue(is_array($userKey));
    }*/

}