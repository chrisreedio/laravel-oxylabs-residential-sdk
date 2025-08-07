<?php

namespace ChrisReedIO\OxylabsResidentialSDK\Requests\SubUsers;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * getSubUserStats
 *
 * Retrieves sub user's traffic stats for a specified time ranged grouped by period.
 *
 * Traffic
 * represents number in `GB` (gigabytes).
 */
class GetSubUserStats extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/users/{$this->userId}/sub-users/{$this->subUserId}";
	}


	/**
	 * @param string $userId
	 * @param int $subUserId
	 * @param string $type `24h` - last 24 hours.
	 *
	 * `week` - last 7 days.
	 *
	 * `month` - last 30 days.
	 *
	 * `current_month` - from the first day of this month to today.
	 *
	 * `lifetime` - since subscription started. (only for sub-users with lifetime subscription).
	 *
	 * `custom` type needs `date_from` and `date_to` query parameters (e.g. 2019-06-15 17). hh (hours) are optional. Queries with hh (hours) parameters are limited to 7 days range.
	 * @param null|string $dateFrom Required for `custom` type
	 * @param null|string $dateTo Required for `custom` type
	 * @param null|string $timeZone Optional TZ identifier for `date_from` and `date_to` fields
	 */
	public function __construct(
		protected string $userId,
		protected int $subUserId,
		protected string $type,
		protected ?string $dateFrom = null,
		protected ?string $dateTo = null,
		protected ?string $timeZone = null,
	) {
	}


	public function defaultQuery(): array
	{
		return array_filter(['type' => $this->type, 'date_from' => $this->dateFrom, 'date_to' => $this->dateTo, 'time_zone' => $this->timeZone]);
	}
}
