<?php

namespace YusamHub\Project0001ClientAuthSdk\Servers\Models;

class ServiceKeyAuthorizeModel
{
    protected static ?ServiceKeyAuthorizeModel $instance = null;

    public static function Instance(): ServiceKeyAuthorizeModel
    {
        if (is_null(static::$instance)) {
            static::$instance = new ServiceKeyAuthorizeModel();
        }
        return static::$instance;
    }

    public ?int $identifierId = null;

    public function assign(ServiceKeyAuthorizeModel|array $properties): ServiceKeyAuthorizeModel
    {
        if ($properties instanceof ServiceKeyAuthorizeModel) {
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