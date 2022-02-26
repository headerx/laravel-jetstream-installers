<?php

namespace HeaderX\JetstreamInstallers;

use HeaderX\JetstreamInstallers\Commands\Lab404ImpersonateInstallerCommand;
use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            ->hasCommand(Lab404ImpersonateInstallerCommand::class);


        $package->hasRoute('impersonate');


        // Register the service the package provides.
        $this->app->singleton('jetstream-installers', function ($app) {
            return new Installer();
        });

        // $this->registerBladeDirectives();
    }

    public function bootingPackage()
    {
        $this->registerBladeDirectives();
    }

    protected function registerBladeDirectives()
    {
        Blade::directive('lab404impersonateinstallerlinks', function () {
            return
                Blade::compileString(
                    '<a href="{{ route(\'users.impersonate.index\') }}" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">'
                        . '{{ __(\'Users\') }}'
                        . '</a>'
                        . '@impersonating'
                        . '<div class="border-t border-gray-100"></div>'
                        . '<a href="{{ route(\'impersonate.leave\') }}" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">'
                        . '{{ __(\'Leave impersonation\') }}'
                        . '</a>'
                        . '@endImpersonating'
                );
        });
    }
}
