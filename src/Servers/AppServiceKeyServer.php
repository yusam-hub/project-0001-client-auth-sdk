<?php

namespace YusamHub\Project0001ClientAuthSdk\Servers;

use YusamHub\Project0001ClientAuthSdk\Exceptions\JsonAuthRuntimeException;
use YusamHub\Project0001ClientAuthSdk\Servers\Models\ServiceKeyAuthorizeModel;

class AppServiceKeyServer extends BaseTokenServer
{
    protected ?array $serviceKeys;
    protected ?string $token;
    protected ?string $sign;
    protected ?string $content;

    /**
     * @param array|null $serviceKeys
     * @param string|null $token
     * @param string|null $sign
     * @param string|null $content
     */
    public function __construct(?array $serviceKeys,
                                ?string $token,
                                ?string $sign,
                                ?string $content)
    {
        $this->serviceKeys = $serviceKeys;
        $this->token = $token;
        $this->sign = $sign;
        $this->content = $content;
    }

    /**
     * @return void
     */
    public function getAuthorizeOrFail(): ServiceKeyAuthorizeModel
    {
        if (empty($this->serviceKeys)) {
            throw new JsonAuthRuntimeException([
                self::TOKEN_KEY_NAME => 'Service keys not defined',
            ]);
        }
        if (empty($this->token)) {
            throw new JsonAuthRuntimeException([
                self::TOKEN_KEY_NAME => 'Token not defined',
            ]);
        }
        if (!isset($this->serviceKeys[$this->token])) {
            throw new JsonAuthRuntimeException([
                self::TOKEN_KEY_NAME => 'Invalid value',
            ]);
        }
        return (new ServiceKeyAuthorizeModel())->assign([
            'identifierId' => $this->serviceKeys[$this->token]
        ]);
    }
}