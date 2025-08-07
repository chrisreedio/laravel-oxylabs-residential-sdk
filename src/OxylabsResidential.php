<?php

namespace ChrisReedIO\OxylabsResidentialSDK;

use ChrisReedIO\OxylabsResidentialSDK\Resource\Login;
use ChrisReedIO\OxylabsResidentialSDK\Resource\SubUsers;
use ChrisReedIO\OxylabsResidentialSDK\Resource\Users;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;

/**
 * Oxylabs Residential Proxy - Public API
 *
 * Public API for management of Oxylabs Residential Proxy service
 */
class OxylabsResidential extends Connector
{
    /**
     * @param  string  $bearerToken  Authentication for the JWT token request (`/v2/login`) only.
     */
    public function __construct(
        protected string $bearerToken,
    ) {}

    public function resolveBaseUrl(): string
    {
        return 'https://residential-api.oxylabs.io/v2';
    }

    public function getAuthenticator(): TokenAuthenticator
    {
        return new TokenAuthenticator($this->bearerToken);
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
