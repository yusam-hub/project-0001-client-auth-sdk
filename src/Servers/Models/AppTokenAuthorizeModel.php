<?php

namespace YusamHub\Project0001ClientAuthSdk\Servers\Models;

class AppTokenAuthorizeModel
{
    protected static ?AppTokenAuthorizeModel $instance = null;

    public static function Instance(): AppTokenAuthorizeModel
    {
        if (is_null(static::$instance)) {
            static::$instance = new AppTokenAuthorizeModel();
        }
        return static::$instance;
    }

    public ?int $appId = null;

    public function assign(AppTokenAuthorizeModel|array $properties): AppTokenAuthorizeModel
    {
        if ($properties instanceof AppTokenAuthorizeModel) {
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