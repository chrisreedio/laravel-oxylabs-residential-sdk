<?php

namespace ChrisReedIO\OxylabsResidentialSDK\Resource;

use ChrisReedIO\OxylabsResidentialSDK\Requests\Users\GetUserClientStats;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class Users extends BaseResource
{
    public function getUserClientStats(string $userId): Response
    {
        return $this->connector->send(new GetUserClientStats($userId));
    }
}
