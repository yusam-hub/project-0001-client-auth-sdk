<?php

namespace YusamHub\Project0001ClientAuthSdk\Servers\Models;

class UserTokenAuthorizeModel
{
    protected static ?UserTokenAuthorizeModel $instance = null;

    public static function Instance(): UserTokenAuthorizeModel
    {
        if (is_null(static::$instance)) {
            static::$instance = new UserTokenAuthorizeModel();
        }
        return static::$instance;
    }

    public ?int $userId = null;

    public function assign(UserTokenAuthorizeModel|array $properties): UserTokenAuthorizeModel
    {
        if ($properties instanceof UserTokenAuthorizeModel) {
            $properties = (array) $properties;
        }
        foreach($properties as $k => $v){
            if (property_exists($this, $k)) {
                $this->{$k} = $v;
            }
        }
        return $this;
    }
}