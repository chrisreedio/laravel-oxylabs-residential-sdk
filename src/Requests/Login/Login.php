<?php

namespace ChrisReedIO\OxylabsResidentialSDK\Requests\Login;

use ChrisReedIO\OxylabsResidentialSDK\Dto\UserToken;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Auth\BasicAuthenticator;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * login
 *
 * Token request must be authenticated using Basic authentication. That is, the token request must
 * include the following header:
 *
 * `Authorization: Basic base64(username:password)`
 *
 * After receiving
 * response, use `token` with all other requests - include the following header:
 *
 * `Authorization:
 * Bearer token`
 *
 * Token will expire after 1 hour.
 *
 * When testing the API call in this sandbox, click the
 * lock icon (on the right) to specify the username and password for authentication.
 */
class Login extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/login';
    }

    public function __construct(
        protected string $username,
        protected string $password,
    ) {}

    public function getAuthenticator(): BasicAuthenticator
    {
        return new BasicAuthenticator($this->username, $this->password);
    }

    public function createDtoFromResponse(Response $response): UserToken
    {
        return UserToken::from($response->json());
    }
}
