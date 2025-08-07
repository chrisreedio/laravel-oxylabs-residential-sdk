<?php

namespace ChrisReedIO\OxylabsResidentialSDK\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class ClientStats extends SpatieData
{
	public function __construct(
		public int|float|null $traffic = null,
		#[MapName('date_from')]
		public ?string $dateFrom = null,
		#[MapName('date_to')]
		public ?string $dateTo = null,
	) {
	}
}
