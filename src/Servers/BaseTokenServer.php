<?php

namespace YusamHub\Project0001ClientAuthSdk\Servers;

abstract class BaseTokenServer
{
    const TOKEN_KEY_NAME = 'X-Token';
    const SIGN_KEY_NAME = 'X-Sign';
    const AUTH_ERROR_CODE_40101 = 40101;
    const AUTH_ERROR_CODE_40102 = 40102;
    const AUTH_ERROR_CODE_40103 = 40103;
    const AUTH_ERROR_CODE_40104 = 40104;
    const AUTH_ERROR_CODE_40105 = 40105;
    const AUTH_ERROR_CODE_40106 = 40106;
    const AUTH_ERROR_MESSAGES = [
        self::AUTH_ERROR_CODE_40101 => 'Invalid identifiers in head',
        self::AUTH_ERROR_CODE_40102 => 'Fail load by identifiers',
        self::AUTH_ERROR_CODE_40103 => 'Fail load payload data',
        self::AUTH_ERROR_CODE_40104 => 'Fail use payload data as identifiers',
        self::AUTH_ERROR_CODE_40105 => 'Token expired',
        self::AUTH_ERROR_CODE_40106 => 'Invalid hash body',
    ];
}