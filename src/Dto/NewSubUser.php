<?php

namespace ChrisReedIO\OxylabsResidentialSDK\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class NewSubUser extends SpatieData
{
    public function __construct(
        public ?string $username = null,
        public ?string $password = null,
        #[MapName('traffic_limit')]
        public int|float|null $trafficLimit = null,
        public ?bool $lifetime = null,
        #[MapName('auto_disable')]
        public ?bool $autoDisable = null,
    ) {}
}
