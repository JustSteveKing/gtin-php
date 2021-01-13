<?php declare(strict_types=1);

namespace JustSteveKing\GtinPHP\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rule;
use JustSteveKing\GtinPHP\Gtin;

class GtinServiceProvider extends ServiceProvider
{
    /**
     * Boot the package
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/gtin.php' => config_path('gtin.php'),
            ], 'config');
        }

        $this->app->singleton('gtin', Gtin::class);
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/gtin.php',
            'gtin'
        );

        Rule::macro('gtin', function () {
            return new \JustSteveKing\GtinPHP\Rules\Gtin;
        });
    }
}
