<?php

namespace ChrisReedIO\OxylabsResidentialSDK\Dto;

use Spatie\LaravelData\Data as SpatieData;

class Error extends SpatieData
{
	public function __construct(
		public ?string $error = null,
	) {
	}
}
