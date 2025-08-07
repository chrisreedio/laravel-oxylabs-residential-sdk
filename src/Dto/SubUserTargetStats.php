<?php

namespace ChrisReedIO\OxylabsResidentialSDK\Dto;

use Spatie\LaravelData\Data as SpatieData;

class SubUserTargetStats extends SpatieData
{
    public function __construct(
        public int|float|null $traffic = null,
        public ?int $requests = null,
        public ?array $results = null,
    ) {}
}
