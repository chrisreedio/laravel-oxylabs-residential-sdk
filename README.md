# Laravel Oxylabs Residential SDK

[![Latest Version on Packagist](https://img.shields.io/packagist/v/chrisreedio/laravel-oxylabs-residential-sdk.svg?style=flat-square)](https://packagist.org/packages/chrisreedio/laravel-oxylabs-residential-sdk)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/chrisreedio/laravel-oxylabs-residential-sdk/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/chrisreedio/laravel-oxylabs-residential-sdk/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/chrisreedio/laravel-oxylabs-residential-sdk/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/chrisreedio/laravel-oxylabs-residential-sdk/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/chrisreedio/laravel-oxylabs-residential-sdk.svg?style=flat-square)](https://packagist.org/packages/chrisreedio/laravel-oxylabs-residential-sdk)

A Laravel SDK that provides a clean, fluent interface to the Oxylabs Residential Proxy Public API. This package simplifies user authentication, sub-user management, and usage statistics retrieval for Oxylabs Residential Proxy services.

## Features

- 🔐 **Authentication** - JWT token-based authentication with automatic token management
- 👥 **Sub-User Management** - Create, update, delete, and retrieve sub-users
- 📊 **Statistics** - Retrieve client usage statistics and sub-user statistics
- 🏗️ **Laravel Integration** - Service provider, facade, and dependency injection support
- 🔧 **Built on Saloon** - Leverages the powerful Saloon HTTP client library
- 🧪 **Fully Tested** - Comprehensive test coverage with Pest

## Installation

You can install the package via Composer:

```bash
composer require chrisreedio/laravel-oxylabs-residential-sdk
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="oxylabs-residential-sdk-config"
```

## Configuration

Set up your Oxylabs credentials in your `.env` file:

```env
OXYLABS_USERNAME=your_username
OXYLABS_PASSWORD=your_password
```

## Usage

### Basic Usage with Facade

```php
use ChrisReedIO\OxylabsResidential\Facades\OxylabsResidential;

// Login and get JWT token
$token = OxylabsResidential::login()->login();

// Get all sub-users
$subUsers = OxylabsResidential::subUsers()->getSubUsers();

// Get client statistics
$stats = OxylabsResidential::users()->getUserClientStats();
```

### Dependency Injection

```php
use ChrisReedIO\OxylabsResidential\OxylabsResidential;

class ProxyController extends Controller
{
    public function __construct(
        private OxylabsResidential $oxylabs
    ) {}
    
    public function getStats()
    {
        $stats = $this->oxylabs->users()->getUserClientStats();
        return response()->json($stats);
    }
}
```

### Sub-User Management

```php
use ChrisReedIO\OxylabsResidential\Dto\NewSubUser;
use ChrisReedIO\OxylabsResidential\Dto\UpdatableSubUserFields;
use ChrisReedIO\OxylabsResidential\Facades\OxylabsResidential;

// Create a new sub-user
$newSubUser = new NewSubUser(
    username: 'john_doe',
    password: 'secure_password',
    traffic_limit: 10000000000 // 10GB in bytes
);

$subUser = OxylabsResidential::subUsers()->createSubUser($newSubUser);

// Update sub-user
$updates = new UpdatableSubUserFields(
    traffic_limit: 20000000000, // 20GB
    is_active: true
);

$updatedUser = OxylabsResidential::subUsers()->updateSubUser($subUser->id, $updates);

// Get sub-user statistics
$stats = OxylabsResidential::subUsers()->getSubUserStats($subUser->id);

// Delete sub-user
OxylabsResidential::subUsers()->deleteSubUser($subUser->id);
```

### Authentication

```php
use ChrisReedIO\OxylabsResidential\Facades\OxylabsResidential;

// Login and receive JWT token
$userToken = OxylabsResidential::login()->login();

echo "Token: " . $userToken->token;
echo "Expires at: " . $userToken->expires_at;
```

### Statistics Retrieval

```php
use ChrisReedIO\OxylabsResidential\Facades\OxylabsResidential;

// Get overall client statistics
$clientStats = OxylabsResidential::users()->getUserClientStats();

echo "Traffic used: " . $clientStats->traffic_used . " bytes";
echo "Traffic limit: " . $clientStats->traffic_limit . " bytes";

// Get specific sub-user statistics
$subUserStats = OxylabsResidential::subUsers()->getSubUserStats($subUserId);

foreach ($subUserStats->target_stats as $target) {
    echo "Country: " . $target->country;
    echo "Traffic: " . $target->traffic . " bytes";
}
```

## Available API Endpoints

### Login Resource
- `login()` - Authenticate and retrieve JWT token

### Sub-Users Resource
- `getSubUsers()` - Retrieve all sub-users
- `createSubUser(NewSubUser $subUser)` - Create a new sub-user
- `updateSubUser(int $id, UpdatableSubUserFields $fields)` - Update sub-user
- `deleteSubUser(int $id)` - Delete sub-user
- `getSubUserStats(int $id)` - Get sub-user statistics

### Users Resource
- `getUserClientStats()` - Get client usage statistics

## Data Transfer Objects (DTOs)

The SDK includes typed DTOs for all API responses:

- `ClientStats` - Overall client statistics
- `SubUser` - Sub-user information
- `SubUserStats` - Sub-user usage statistics
- `SubUserTargetStats` - Country/target-specific statistics
- `UserToken` - JWT authentication token
- `NewSubUser` - Data for creating sub-users
- `UpdatableSubUserFields` - Data for updating sub-users
- `Error` - API error responses

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Chris Reed](https://github.com/chrisreedio)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
