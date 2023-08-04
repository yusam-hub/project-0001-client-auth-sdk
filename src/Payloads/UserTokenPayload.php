<?php

namespace YusamHub\Project0001ClientAuthSdk\Payloads;

class UserTokenPayload
{
    public ?int $uid = null;
    public ?int $now = null;
    public ?int $exp = null;
    public ?string $hb = null;
    public function __construct(array $properties = [])
    {
        foreach ($properties as $k => $v) {
            if (property_exists($this, $k)) {
                $this->{$k} = $v;
            }
        }
    }
}