<?php

namespace ChrisReedIO\OxylabsResidentialSDK\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ChrisReedIO\OxylabsResidential\OxylabsResidential
 */
class OxylabsResidential extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \ChrisReedIO\OxylabsResidentialSDK\OxylabsResidential::class;
    }
}
