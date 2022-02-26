<?php

namespace HeaderX\JetstreamInstallers\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \HeaderX\Installer
 */
class Installer extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-jetstream-installers';
    }
}
