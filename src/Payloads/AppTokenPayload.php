<?php

namespace YusamHub\Project0001ClientAuthSdk\Payloads;

class AppTokenPayload
{
    public ?int $aid = null;
    public ?int $iat = null;
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