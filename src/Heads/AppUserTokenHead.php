<?php

namespace YusamHub\Project0001ClientAuthSdk\Heads;

class AppUserTokenHead extends BaseTokenHead
{
    public ?int $aid = null;
    public ?int $uid = null;
    public ?string $did = null;
}