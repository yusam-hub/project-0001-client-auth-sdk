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

    /**
     * @param string $method
     * @param array|string $content
     * @return string
     */
    protected function generateUserToken(string $method, array|string $content): string
    {
        if (is_array($content)) {
            if (empty($content)) {
                $content = '';
            } else {
                if ($method === $this->api::METHOD_GET) {
                    $content = http_build_query($content);
                } else {
                    $content = json_encode($content);
                }
            }
        } elseif (!is_string($content)) {
            throw new \RuntimeException("Invalid content, require string");
        }
        return JwtAuthUserTokenHelper::toJwt($this->userId, $this->privateKey, md5($content));
    }

    /**
     * @param string $requestMethod
     * @param string $requestUri
     * @param array $requestParams
     * @return array|null
     */
    protected function doAppRequest(
        string $requestMethod,
        string $requestUri,
        array $requestParams,
    ): ?array
    {
        $headers = [
            'Accept' => $this->api::CONTENT_TYPE_APPLICATION_JSON,
            self::USER_TOKEN_KEY_NAME => $this->generateUserToken($requestMethod, $requestParams),
        ];

        if ($requestMethod !== $this->api::METHOD_GET) {
            $headers[$this->api::HEADER_CONTENT_TYPE] = $this->api::CONTENT_TYPE_APPLICATION_JSON;
        }

        $response = $this->api->request($requestMethod, $requestUri, $requestParams, $headers);

        if ($response->isStatusCode(200) && $response->isContentTypeJson()) {
            return $response->toArray();
        }

        return null;
    }

    /**
     * @return array|null
     */
    public function getAppList(): ?array
    {
        return $this->doAppRequest(
            $this->api::METHOD_GET,
            '/api/front/app/list',
            []
        );
    }

    /**
     * @param string $title
     * @return array|null
     */
    public function postAppAdd(string $title): ?array
    {
        return $this->doAppRequest(
            $this->api::METHOD_POST,
            '/api/front/app/add',
            get_defined_vars()
        );
    }

    /**
     * @param int $appId
     * @return array|null
     */
    public function getAppId(int $appId): ?array
    {
        return $this->doAppRequest(
            $this->api::METHOD_GET,
            strtr('/api/front/app/id/{appId}',[
                '{appId}' => $appId
            ]),
            []
        );
    }

    /**
     * @param int $appId
     * @param string $title
     * @return array|null
     */
    public function putAppIdChangeTitle(int $appId, string $title): ?array
    {
        return $this->doAppRequest(
            $this->api::METHOD_PUT,
            strtr('/api/front/app/id/{appId}/change-title',[
                '{appId}' => $appId
            ]),
            [
                'title' => $title
            ]
        );
    }
}