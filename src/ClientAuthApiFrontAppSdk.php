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
            throw new \RuntimeException(sprintf("baseUrl not exists in config"));
        }
        if (!isset($config['isDebugging'])) {
            throw new \RuntimeException(sprintf("isDebugging not exists in config"));
        }
        if (!isset($config['userId'])) {
            throw new \RuntimeException(sprintf("userId not exists in config"));
        }
        if (!isset($config['privateKey'])) {
            throw new \RuntimeException(sprintf("privateKey not exists in config"));
        }
        foreach($config as $k => $v) {
            if (property_exists($this, $k)) {
                $this->{$k} = $v;
            }
        }
        $this->api = new CurlExtDebug($config['baseUrl']);
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

    protected function generateUserToken(string $content): string
    {
        return JwtAuthUserTokenHelper::toJwt($this->userId, $this->privateKey, $content);
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
                self::USER_TOKEN_KEY_NAME => $this->generateUserToken(json_encode($requestParams, true)),
            ]
        );

        if ($response->isStatusCode(200) && $response->isContentTypeJson()) {
            return $response->toArray();
        }

        return null;
    }
}