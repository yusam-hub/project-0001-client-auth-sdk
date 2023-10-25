<?php

namespace YusamHub\Project0001ClientAuthSdk\Servers\Models;

class AppUserTokenAuthorizeModel
{
    protected static ?AppUserTokenAuthorizeModel $instance = null;

    public static function Instance(): AppUserTokenAuthorizeModel
    {
        if (is_null(static::$instance)) {
            static::$instance = new AppUserTokenAuthorizeModel();
        }
        return static::$instance;
    }

    public ?int $appId = null;

    public ?int $userId = null;

    public ?string $deviceUuid = null;

    public function assign(AppUserTokenAuthorizeModel|array $properties): AppUserTokenAuthorizeModel
    {
        if ($properties instanceof AppUserTokenAuthorizeModel) {
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