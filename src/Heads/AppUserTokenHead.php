<?php

namespace YusamHub\Project0001ClientAuthSdk\Heads;

class AppUserTokenHead extends BaseTokenHead
{
    public ?int $uid = null;
    public ?int $aid = null;
    public ?string $did = null;
}