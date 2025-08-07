# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Development Commands

### Testing
- `composer test` - Run all tests with Pest
- `composer test-coverage` - Run tests with coverage report
- `vendor/bin/pest tests/ExampleTest.php` - Run a specific test file
- `vendor/bin/pest --filter="test name"` - Run a specific test by name

### Code Quality
- `composer analyse` - Run PHPStan static analysis (level 5)
- `composer format` - Format code with Laravel Pint
- `vendor/bin/pint --test` - Check code style without making changes

### Package Development
- `composer prepare` - Discover package for Laravel (runs automatically after autoload-dump)

## Architecture Overview

This is a Laravel package that provides an SDK interface to the Oxylabs Residential Proxy Public API. The architecture follows these key patterns:

### Saloon HTTP Client Integration
The package is built on top of Saloon v3, providing a modern HTTP client experience:
- `OxylabsResidentialSDK` extends `Saloon\Http\Connector` as the main API connector
- Supports both Basic Auth (username/password) and Bearer token authentication via `MultiAuthenticator`
- Base URL is set to `/v2` for the Oxylabs API v2 endpoints

### Resource-Request Pattern
API functionality is organized using Saloon's resource pattern:
- **Resources** (`src/Resource/`): High-level API groupings (Login, SubUsers, Users)
  - Each extends `BaseResource` and provides convenient methods
  - Resources instantiate and send specific Request objects
- **Requests** (`src/Requests/`): Individual API endpoint implementations
  - Organized by resource type in subdirectories
  - Each extends Saloon's `Request` class
  - Requests with payloads implement `HasBody` interface

### Data Transfer Objects (DTOs)
Strongly typed data structures in `src/Dto/`:
- `NewSubUser`, `UpdatableSubUserFields` - Input DTOs for API requests  
- `ClientStats`, `SubUser`, `SubUserStats`, etc. - Response DTOs
- `UserToken` - Authentication response structure
- `Error` - API error response structure

### Laravel Package Structure
Standard Laravel package using Spatie's Package Tools:
- Service Provider: `OxylabsResidentialServiceProvider`
- Facade: `OxylabsResidential` (facade accessor points to main class)
- Configuration: `config/oxylabs-residential-sdk.php` (currently empty)
- Commands: `OxylabsResidentialCommand` available via Artisan
- Migrations and Views are configured but may not be actively used

### Testing Setup
- Uses Orchestra Testbench for Laravel package testing
- Pest PHP as the testing framework
- TestCase sets up factory namespace guessing and test database
- PHPStan configured at level 5 with Octane compatibility checks

### Key API Resources
1. **Login Resource**: JWT authentication (`/v2/login`)
2. **SubUsers Resource**: CRUD operations for sub-users with statistics
3. **Users Resource**: Client usage statistics retrieval

## Development Notes

### Authentication Flow
The SDK handles dual authentication modes:
1. Basic auth for initial login requests to get JWT tokens
2. Bearer token auth for subsequent API calls

### Namespace Inconsistency
Note: There's a namespace inconsistency in the codebase:
- Package namespace: `ChrisReedIO\OxylabsResidential`
- SDK class namespace: `ChrisReedIO\OxylabsResidentialSDK`
This should be considered when making changes or additions.

### Configuration
The package supports Laravel's standard configuration publishing, though the config file is currently empty. Environment variables for credentials should follow the pattern established in the README.