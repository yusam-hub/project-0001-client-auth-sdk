<?php

namespace YusamHub\Project0001ClientAuthSdk\Tests;

use YusamHub\Project0001ClientAuthSdk\ClientAuthAdminSdk;
use YusamHub\Project0001ClientAuthSdk\ClientAuthAppSdk;
use YusamHub\Project0001ClientAuthSdk\ClientAuthUserSdk;
use YusamHub\Project0001ClientAuthSdk\Tokens\JwtAuthUserTokenHelper;

class ClientAuthSdkTest extends \PHPUnit\Framework\TestCase
{
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

        $accessToken = $clientAuthUserSdk->postApiUserAppAccessToken(
            1,
            '12345678901234567890123456789012',
            $appIdRefresh['data']['publicKeyHash'],
            $appIdRefresh['data']['privateKey'],
        );
        $this->assertTrue(is_array($accessToken));
        var_dump($accessToken);
    }*/

    /*public function testGetAppKeyList()
    {
        $clientAuthUserSdk = new ClientAuthUserSdk(Config::getConfig('user-sdk'));
        $appKeyList = $clientAuthUserSdk->getApiUserAppIdKeyList(1);
        $this->assertTrue(is_array($appKeyList));
    }*/

    /*public function testGetAppUserKey()
    {
        $clientAuthAppSdk = new ClientAuthAppSdk(Config::getConfig('app-sdk'));
        $accessToken = $clientAuthAppSdk->getApiAppAccessToken('9ac1982ea2a19026bbff28a9de4a4ec3');
        $this->assertTrue(is_array($accessToken));
    }*/

}