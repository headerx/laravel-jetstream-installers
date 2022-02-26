<?php

namespace HeaderX\JetstreamInstallers;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use HeaderX\JetstreamInstallers\Commands\JetstreamInstallersCommand;

class JetstreamInstallersServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-jetstream-installers')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-jetstream-installers_table')
            ->hasCommand(JetstreamInstallersCommand::class);

        // Register the service the package provides.
        $this->app->singleton('laravel-jetstream-installers', function ($app) {
            return new JetstreamInstallers;
        });
    }
}
