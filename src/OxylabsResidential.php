<?php

namespace ChrisReedIO\OxylabsResidentialSDK;

use ChrisReedIO\OxylabsResidentialSDK\Resource\Login;
use ChrisReedIO\OxylabsResidentialSDK\Resource\SubUsers;
use ChrisReedIO\OxylabsResidentialSDK\Resource\Users;
use Illuminate\Support\Facades\Cache;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\Http\Response;

/**
 * Oxylabs Residential Proxy - Public API
 *
 * Public API for management of Oxylabs Residential Proxy service
 */
class OxylabsResidential extends Connector
{
    protected ?string $bearerToken = null;

    const string TOKEN_CACHE_KEY = 'oxylabs-residential-sdk-token';

    const string USER_ID_CACHE_KEY = 'oxylabs-residential-sdk-user-id';

    const int TOKEN_CACHE_TTL = 60 * 60; // 1 hour

    /**
     * @param  ?string  $bearerToken  Authentication for the JWT token request (`/v2/login`) only. If not provided, the connector will attempt to get it from the cache.
     */
    public function __construct(
        ?string $bearerToken = null,
    ) {
        // if no bearer token is provided, try to get it from the cache
        if ($bearerToken) {
            $this->bearerToken = $bearerToken;
        } else {
            $this->bearerToken = Cache::get(self::TOKEN_CACHE_KEY);
        }
    }

    public function resolveBaseUrl(): string
    {
        return 'https://residential-api.oxylabs.io/v2';
    }

    public function getAuthenticator(): TokenAuthenticator
    {
        $this->bearerToken ??= Cache::get(self::TOKEN_CACHE_KEY);

        // If we still don't have a token, attempt to  login
        if (! $this->bearerToken) {
            $username = config('oxylabs-residential-sdk.username');
            $password = config('oxylabs-residential-sdk.password');
            $loginResponse = $this->bearerToken = $this->login()->login($username, $password);
            if ($loginResponse->failed()) {
                throw new \Exception('Failed to login to Oxylabs Residential API');
            }
            $loginDto = $loginResponse->dto();
            $this->bearerToken = $loginDto->token;
            Cache::put(self::TOKEN_CACHE_KEY, $this->bearerToken, self::TOKEN_CACHE_TTL);
            Cache::put(self::USER_ID_CACHE_KEY, $loginDto->userId, self::TOKEN_CACHE_TTL);
        }

        if (! $this->bearerToken) {
            throw new \Exception('Oxylabs Residential API general authentication failure');
        }

        return new TokenAuthenticator($this->bearerToken);
    }

    public function login(string $username, string $password): Response
    {
        return (new Login($this))->login($username, $password);
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
