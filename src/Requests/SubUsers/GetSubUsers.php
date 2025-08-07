<?php

namespace ChrisReedIO\OxylabsResidentialSDK\Requests\SubUsers;

use ChrisReedIO\OxylabsResidentialSDK\Requests\BaseRequest;
use Saloon\Enums\Method;

/**
 * getSubUsers
 *
 * Retrieves all active sub users for the given user.
 */
class GetSubUsers extends BaseRequest
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/users/{$this->getUserId()}/sub-users";
    }
}
