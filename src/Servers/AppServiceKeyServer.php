<?php

namespace YusamHub\Project0001ClientAuthSdk\Servers;

use YusamHub\Project0001ClientAuthSdk\Exceptions\JsonAuthRuntimeException;
class AppServiceKeyServer extends BaseTokenServer
{
    protected ?string $serviceKey;
    protected ?string $token;
    protected ?string $sign;
    protected ?string $content;

    /**
     * @param string|null $serviceKey
     * @param string|null $token
     * @param string|null $sign
     * @param string|null $content
     */
    public function __construct(?string $serviceKey,
                                ?string $token,
                                ?string $sign,
                                ?string $content)
    {
        $this->serviceKey = $serviceKey;
        $this->token = $token;
        $this->sign = $sign;
        $this->content = $content;
    }

    /**
     * @return void
     */
    public function authorizeOrFail(): void
    {
        if (empty($this->serviceKey)) {
            throw new JsonAuthRuntimeException([
                self::TOKEN_KEY_NAME => 'Service key not defined',
            ]);
        }
        if (empty($this->token)) {
            throw new JsonAuthRuntimeException([
                self::TOKEN_KEY_NAME => 'Token not defined',
            ]);
        }
        if ($this->token != $this->serviceKey) {
            throw new JsonAuthRuntimeException([
                self::TOKEN_KEY_NAME => 'Invalid value',
            ]);
        }
    }
}