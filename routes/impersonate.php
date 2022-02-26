<?php

use HeaderX\JetstreamInstallers\Controllers\Lab404Impersonate\UserController;
use Illuminate\Support\Facades\Route;

if (config('jetstream-installers.lab404-impersonate.enabled')) {
    Route::get('/lab404', [UserController::class, 'index'])
        ->prefix(config('jetstream-installers.lab404-impersonate.route_prefix'))
        ->middleware(config('jetstream-installers.lab404-impersonate.middleware'))
        ->name('users.impersonate.index');
}
