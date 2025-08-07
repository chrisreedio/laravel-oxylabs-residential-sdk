<?php

namespace ChrisReedIO\OxylabsResidentialSDK\Resource;

use ChrisReedIO\OxylabsResidentialSDK\Requests\SubUsers\CreateSubUser;
use ChrisReedIO\OxylabsResidentialSDK\Requests\SubUsers\DeleteSubUser;
use ChrisReedIO\OxylabsResidentialSDK\Requests\SubUsers\GetSubUserStats;
use ChrisReedIO\OxylabsResidentialSDK\Requests\SubUsers\GetSubUsers;
use ChrisReedIO\OxylabsResidentialSDK\Requests\SubUsers\UpdateSubUser;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class SubUsers extends BaseResource
{
	/**
	 * @param string $userId
	 */
	public function getSubUsers(string $userId): Response
	{
		return $this->connector->send(new GetSubUsers($userId));
	}


	/**
	 * @param string $userId
	 */
	public function createSubUser(string $userId): Response
	{
		return $this->connector->send(new CreateSubUser($userId));
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
	 * @param string $dateFrom Required for `custom` type
	 * @param string $dateTo Required for `custom` type
	 * @param string $timeZone Optional TZ identifier for `date_from` and `date_to` fields
	 */
	public function getSubUserStats(
		string $userId,
		int $subUserId,
		string $type,
		?string $dateFrom = null,
		?string $dateTo = null,
		?string $timeZone = null,
	): Response
	{
		return $this->connector->send(new GetSubUserStats($userId, $subUserId, $type, $dateFrom, $dateTo, $timeZone));
	}


	/**
	 * @param string $userId
	 * @param int $subUserId
	 */
	public function deleteSubUser(string $userId, int $subUserId): Response
	{
		return $this->connector->send(new DeleteSubUser($userId, $subUserId));
	}


	/**
	 * @param string $userId
	 * @param int $subUserId
	 */
	public function updateSubUser(string $userId, int $subUserId): Response
	{
		return $this->connector->send(new UpdateSubUser($userId, $subUserId));
	}


	/**
	 * @todo Fix duplicated method name
	 * @param string $userId
	 * @param int $subUserId
	 * @param string $date
	 */
	public function updateSubUserDuplicate1(string $userId, int $subUserId, string $date): Response
	{
		return $this->connector->send(new UpdateSubUser($userId, $subUserId, $date));
	}
}
