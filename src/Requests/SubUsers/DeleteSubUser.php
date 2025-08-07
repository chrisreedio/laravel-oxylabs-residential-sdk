<?php

namespace ChrisReedIO\OxylabsResidentialSDK\Requests\SubUsers;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * deleteSubUser
 */
class DeleteSubUser extends Request
{
	protected Method $method = Method::DELETE;


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
