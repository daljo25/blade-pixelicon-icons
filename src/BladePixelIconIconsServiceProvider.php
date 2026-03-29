<?php

declare(strict_types=1);

namespace Daljo25\BladePixelIconIcons;

use BladeUI\Icons\Factory;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

final class BladePixelIconIconsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfig();

        $this->callAfterResolving(Factory::class, function (Factory $factory, Container $container) {
            $config = $container->make('config')->get('blade-pixelicon-icons', []);

            $factory->add('pixelicon', array_merge([
                'path' => __DIR__.'/../resources/svg',
            ], $config));
        });
    }

    private function registerConfig(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/blade-pixelicon-icons.php',
            'blade-pixelicon-icons'
        );
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {

            // publish svg
            $this->publishes([
                __DIR__.'/../resources/svg' => public_path('vendor/blade-pixelicon-icons'),
            ], 'blade-pixelicon-icons');

            // publish config
            $this->publishes([
                __DIR__.'/../config/blade-pixelicon-icons.php' => $this->app->configPath('blade-pixelicon-icons.php'),
            ], 'blade-pixelicon-icons-config');
        }
    }
}