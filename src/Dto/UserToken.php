<?php

namespace ChrisReedIO\OxylabsResidentialSDK\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class UserToken extends SpatieData
{
    public function __construct(
        #[MapName('user_id')]
        public ?string $userId = null,
        public ?string $token = null,
    ) {}
}
