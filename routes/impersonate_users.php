<?php

Route::prefix(config('laravel-jetstream-installers.lab404-impersonate.route_prefix'))
    ->as('users.impersonate.')
    ->middleware($middleware)
    ->group(function () {

    // USERS
    Route::resource('users', 'UserController');

});