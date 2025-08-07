<?php

namespace ChrisReedIO\OxylabsResidentialSDK\Requests;

use ChrisReedIO\OxylabsResidentialSDK\OxylabsResidential;
use Illuminate\Support\Facades\Cache;
use Saloon\Http\Request;

abstract class BaseRequest extends Request
{
    /**
     * Get the user ID from the cache.
     */
    public function getUserId(): ?string
    {
        return Cache::get(OxylabsResidential::USER_ID_CACHE_KEY);
    }
}
