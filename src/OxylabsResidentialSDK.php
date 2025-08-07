<?php

namespace ChrisReedIO\OxylabsResidentialSDK;

use ChrisReedIO\OxylabsResidentialSDK\Resource\Login;
use ChrisReedIO\OxylabsResidentialSDK\Resource\SubUsers;
use ChrisReedIO\OxylabsResidentialSDK\Resource\Users;
use Saloon\Http\Auth\BasicAuthenticator;
use Saloon\Http\Auth\MultiAuthenticator;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;

/**
 * Oxylabs Residential Proxy - Public API
 *
 * Public API for management of Oxylabs Residential Proxy service
 */
class OxylabsResidentialSDK extends Connector
{
	/**
	 * @param string $username Authentication for the JWT token request (`/v2/login`) only.
	 * @param string $password Authentication for the JWT token request (`/v2/login`) only.
	 * @param string $bearerToken
	 */
	public function __construct(
		protected string $username,
		protected string $password,
		protected string $bearerToken,
	) {
	}


	public function resolveBaseUrl(): string
	{
		return "/v2";
	}


	public function getAuthenticator(): MultiAuthenticator
	{
		return new MultiAuthenticator(
			new BasicAuthenticator($this->username, $this->password),
			new TokenAuthenticator($this->bearerToken, "Bearer")
		);
	}


	public function login(): Login
	{
		return new Login($this);
	}


	public function subUsers(): SubUsers
	{
		return new SubUsers($this);
	}


	public function users(): Users
	{
		return new Users($this);
	}
}
