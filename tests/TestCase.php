<?php

namespace SmartDato\Desk365\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use Saloon\Http\Faking\MockClient;
use SmartDato\Desk365\Desk365ServiceProvider;
use Spatie\LaravelData\LaravelDataServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'SmartDato\\Desk365\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    /**
     * MockClient::global() is a ??= assignment, so the first test to call it
     * wins and every later call silently returns that first set of mocks.
     * Saloon expects it to be torn down between tests.
     */
    protected function tearDown(): void
    {
        MockClient::destroyGlobal();

        parent::tearDown();
    }

    protected function getPackageProviders($app): array
    {
        return [
            LaravelDataServiceProvider::class,
            Desk365ServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');

        config()->set('desk365-sdk.api_key', 'test_api_key');
        config()->set('desk365-sdk.base_url', 'https://omest.desk365.io/apis/');

        /*
         foreach (\Illuminate\Support\Facades\File::allFiles(__DIR__ . '/../database/migrations') as $migration) {
            (include $migration->getRealPath())->up();
         }
         */
    }
}
