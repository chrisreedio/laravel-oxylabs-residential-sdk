<?php

namespace ChrisReedIO\OxylabsResidentialSDK\Dto;

use Spatie\LaravelData\Data as SpatieData;

class SubUserStats extends SpatieData
{
    public function __construct(
        public int|float|null $traffic = null,
        public ?array $results = null,
    ) {}
}
