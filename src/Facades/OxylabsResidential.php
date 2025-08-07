<?php

namespace ChrisReedIO\OxylabsResidential\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ChrisReedIO\OxylabsResidential\OxylabsResidential
 */
class OxylabsResidential extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \ChrisReedIO\OxylabsResidential\OxylabsResidential::class;
    }
}
