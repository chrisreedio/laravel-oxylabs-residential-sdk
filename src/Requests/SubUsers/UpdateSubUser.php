<?php

namespace ChrisReedIO\OxylabsResidentialSDK\Requests\SubUsers;

use DateTime;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * updateSubUser
 *
 * `password` (optional) must be between 12 and 64 characters long, must contain a lowercase, uppercase
 * letter, a digit, and one of the following special characters: #_~+=
 *
 * `traffic_limit` (optional)
 * available values: null - unlimited traffic; {double} (e.g. 20) - 20 GB limit; 0 - no more traffic
 * allowed
 *
 * `lifetime` (optional) makes subscription period unlimited (no recurring traffic
 * resets).
 *
 * `status` (optional) available values: "active", "disabled"
 *
 * `auto_disable` (optional)
 * available values: true - disable when traffic limit is reached; false - do not disable when traffic
 * limit is reached.
 */
class UpdateSubUser extends Request implements HasBody
{
	use HasJsonBody;

	protected Method $method = Method::PATCH;


	public function resolveEndpoint(): string
	{
		return "/users/{$this->userId}/sub-users/{$this->subUserId}";
	}


	/**
	 * @param string $userId
	 * @param int $subUserId
	 */
	public function __construct(
		protected string $userId,
		protected int $subUserId,
	) {
	}
}
