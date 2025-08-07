<?php

namespace ChrisReedIO\OxylabsResidentialSDK;

use ChrisReedIO\OxylabsResidentialSDK\Commands\OxylabsResidentialCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class OxylabsResidentialServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-oxylabs-residential-sdk')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel_oxylabs_residential_sdk_table')
            ->hasCommand(OxylabsResidentialCommand::class);
    }
}
