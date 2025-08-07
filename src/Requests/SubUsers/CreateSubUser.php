<?php

namespace ChrisReedIO\OxylabsResidentialSDK\Requests\SubUsers;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * createSubUser
 *
 * `username` (required) must consist of letters, digits, and underscores.
 *
 * `password` (required) must
 * be between 12 and 64 characters long, must contain a lowercase, uppercase letter, a digit, and one
 * of the following special characters: #_~+=
 *
 * `traffic_limit` (optional) available values: null -
 * unlimited traffic; {double} (e.g. 20) - 20 GB limit; 0 - no more traffic allowed.
 *
 * `lifetime`
 * (optional) makes subscription period unlimited (no recurring traffic resets).
 *
 * `auto_disable`
 * (optional) available values: true - disable when traffic limit is reached. false - do not disable
 * when traffic limit is reached.
 */
class CreateSubUser extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return "/users/{$this->userId}/sub-users";
    }

    public function __construct(
        protected string $userId,
    ) {}
}
