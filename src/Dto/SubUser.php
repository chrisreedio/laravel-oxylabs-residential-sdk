<?php

namespace ChrisReedIO\OxylabsResidentialSDK\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class SubUser extends SpatieData
{
	public function __construct(
		public ?int $id = null,
		public ?string $username = null,
		public ?string $status = null,
		#[MapName('created_at')]
		public ?string $createdAt = null,
		public int|float|null $traffic = null,
		#[MapName('traffic_limit')]
		public int|float|null $trafficLimit = null,
		#[MapName('auto_disable')]
		public ?bool $autoDisable = null,
		public ?bool $lifetime = null,
	) {
	}
}
