<?php

namespace ChrisReedIO\OxylabsResidentialSDK\Requests\SubUsers;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * getSubUsers
 *
 * Retrieves all active sub users for the given user.
 */
class GetSubUsers extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/users/{$this->userId}/sub-users";
	}


	/**
	 * @param string $userId
	 */
	public function __construct(
		protected string $userId,
	) {
	}
}
