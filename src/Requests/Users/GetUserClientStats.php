<?php

namespace ChrisReedIO\OxylabsResidentialSDK\Requests\Users;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * getUserClientStats
 *
 * Retrieves user's traffic stats for the current month.
 *
 * Traffic represents number in `GB`
 * (gigabytes).
 */
class GetUserClientStats extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/users/{$this->userId}/client-stats";
    }

    public function __construct(
        protected string $userId,
    ) {}
}
