<?php

namespace YusamHub\Project0001ClientAuthSdk\Tests;

use YusamHub\Project0001ClientAuthSdk\ClientAuthAdminSdk;
use YusamHub\Project0001ClientAuthSdk\ClientAuthAppSdk;
use YusamHub\Project0001ClientAuthSdk\ClientAuthUserSdk;
use YusamHub\Project0001ClientAuthSdk\Tokens\JwtAuthUserTokenHelper;

class ClientAuthSdkTest extends \PHPUnit\Framework\TestCase
{
    /*public function testJWT()
    {
        $config = Config::getConfig('user-sdk');
        $jwt = JwtAuthUserTokenHelper::toJwt($config['identifierId'], $config['privateKey'], md5("test"));
        $this->assertTrue($jwt != '');
        $userId = JwtAuthUserTokenHelper::getUserFromJwtHeads($jwt);
        $this->assertTrue($userId === intval($config['identifierId']));
        $userPayload = JwtAuthUserTokenHelper::fromJwtAsPayload($jwt, $config['publicKey']);
        $this->assertTrue($userPayload->uid === intval($config['identifierId']));
    }*/

    /*public function testPostAppAdd()
    {
        $clientAuthAdminSdk = new ClientAuthAdminSdk(Config::getConfig('user-sdk'));
        $appAdd = $clientAuthAdminSdk->postApiAdminAppAdd('Testing');
        $this->assertTrue(is_array($appAdd));
    }*/

    /*public function testGetAppList()
    {
        $clientAuthAdminSdk = new ClientAuthAdminSdk(Config::getConfig('user-sdk'));
        $appList = $clientAuthAdminSdk->getApiAdminAppList();
        $this->assertTrue(is_array($appList));
    }*/

    /*public function testGetAppId()
    {
        $clientAuthAdminSdk = new ClientAuthAdminSdk(Config::getConfig('user-sdk'));
        $app = $clientAuthAdminSdk->getApiAdminAppId(1);
        $this->assertTrue(is_array($app));
    }*/

    /*public function testPutAppIdChangeTitle()
    {
        $clientAuthAdminSdk = new ClientAuthAdminSdk(Config::getConfig('user-sdk'));
        $app = $clientAuthAdminSdk->putApiAdminAppIdChangeTitle(1, 'Testing');
        $this->assertTrue(is_array($app));
    }*/

    /*public function testPutAppIdChangeKeys()
    {
        $clientAuthAdminSdk = new ClientAuthAdminSdk(Config::getConfig('user-sdk'));
        $app = $clientAuthAdminSdk->putApiAdminAppIdChangeKeys(1);
        $this->assertTrue(is_array($app));
    }*/

    /*public function testPostAppIdRefresh()
    {
        $clientAuthUserSdk = new ClientAuthUserSdk(Config::getConfig('user-sdk'));
        $appIdRefresh = $clientAuthUserSdk->postApiUserAppIdKeyRefresh(1,'12345678901234567890123456789012');
        $this->assertTrue(is_array($appIdRefresh));
        var_dump($appIdRefresh);
    }*/

    public function testGetAppKeyList()
    {
        $clientAuthUserSdk = new ClientAuthUserSdk(Config::getConfig('user-sdk'));
        $appKeyList = $clientAuthUserSdk->getApiUserAppIdKeyList(1);
        $this->assertTrue(is_array($appKeyList));
    }

    /*public function testGetAppUserKey()
    {
        $clientAuthAppSdk = new ClientAuthAppSdk(Config::getConfig('app-sdk'));
        $accessToken = $clientAuthAppSdk->getApiAppAccessToken('68db6b84de6e9a2fbddd211bb9fe9a69');
        $this->assertTrue(is_array($accessToken));
    }*/

}