<?php

namespace ChrisReedIO\OxylabsResidentialSDK\Resource;

use ChrisReedIO\OxylabsResidentialSDK\Requests\Login\Login as LoginRequest;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class Login extends BaseResource
{
	public function login(): Response
	{
		return $this->connector->send(new LoginRequest());
	}
}
