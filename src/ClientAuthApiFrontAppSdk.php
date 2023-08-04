<?php

namespace YusamHub\Project0001ClientAuthSdk;

use YusamHub\CurlExt\CurlExtDebug;
use YusamHub\Project0001ClientAuthSdk\Tokens\JwtAuthUserTokenHelper;

class ClientAuthApiFrontAppSdk
{
    const USER_TOKEN_KEY_NAME = 'X-User-Token';
    protected CurlExtDebug $api;
    protected bool $isDebugging;
    protected int $userId;
    protected string $privateKey;

    public function __construct(array $config = [])
    {
        if (!isset($config['baseUrl'])) {
            throw new \RuntimeException("baseUrl not exists in config");
        }
        if (!isset($config['isDebugging'])) {
            throw new \RuntimeException("isDebugging not exists in config");
        }
        if (!isset($config['userId'])) {
            throw new \RuntimeException("userId not exists in config");
        }
        if (!isset($config['privateKey'])) {
            throw new \RuntimeException("privateKey not exists in config");
        }
        if (!isset($config['storageLogFile'])) {
            throw new \RuntimeException("storageLogFile not exists in config");
        }
        foreach($config as $k => $v) {
            if (property_exists($this, $k)) {
                $this->{$k} = $v;
            }
        }
        $this->api = new CurlExtDebug($config['baseUrl'], $config['storageLogFile']);
        $this->api->isDebugging = $this->isDebugging();
    }

    public function getApi(): CurlExtDebug
    {
        return $this->api;
    }

    public function isDebugging(): bool
    {
        return $this->isDebugging;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getPrivateKey(): string
    {
        return $this->privateKey;
    }

    protected function generateUserToken($method, $content): string
    {
        if (is_array($content)) {
            if (empty($content)) {
                $content = '';
            } else {
                if ($method === 'GET') {
                    $content = http_build_query($content);
                }  else {
                    $content = json_encode($content);
                }
            }
        }
        return JwtAuthUserTokenHelper::toJwt($this->userId, $this->privateKey, md5($content));
    }

    public function getAppList(): ?array
    {
        $requestMethod = "GET";

        $requestUri = "/api/front/app/list";

        $requestParams = [
        ];

        $response = $this->api->request($requestMethod, $requestUri, $requestParams,
            [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                self::USER_TOKEN_KEY_NAME => $this->generateUserToken($requestParams),
            ]
        );

        if ($response->isStatusCode(200) && $response->isContentTypeJson()) {
            return $response->toArray();
        }

        return null;
    }
}