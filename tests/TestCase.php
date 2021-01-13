<?php declare(strict_types=1);

namespace JustSteveKing\GtinPHP\Tests;

use JustSteveKing\GtinPHP\Providers\GtinServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            GtinServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        // any specific env options that need to be set for this package to work
    }
}
