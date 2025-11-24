<?php

namespace SmartDato\Desk365;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class Desk365ServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('desk365-sdk')
            ->hasConfigFile();
    }

    public function packageRegistered(): void
    {
        $this->app->singleton(Desk365::class, function ($app) {
            $config = $app['config']['desk365-sdk'];

            return new Desk365(
                apiKey: $config['api_key'] ?? null,
                baseUrl: $config['base_url'] ?? null,
                version: $config['version'] ?? null,
            );
        });
    }
}
