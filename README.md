# The missing commands to install various packages into the Jetstream skeleton

[![Latest Version on Packagist](https://img.shields.io/packagist/v/headerx/laravel-jetstream-installers.svg?style=flat-square)](https://packagist.org/packages/headerx/laravel-jetstream-installers)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/headerx/laravel-jetstream-installers/run-tests?label=tests)](https://github.com/headerx/laravel-jetstream-installers/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/headerx/laravel-jetstream-installers/Check%20&%20fix%20styling?label=code%20style)](https://github.com/headerx/laravel-jetstream-installers/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/headerx/laravel-jetstream-installers.svg?style=flat-square)](https://packagist.org/packages/headerx/laravel-jetstream-installers)

## Supported packages

Currently the only command/installer available is for `lab404/laravel-impersonate`

## Supported Operating Systems

| Command                                  | Windows       | Mac           | Ubuntu       |
| ---------------------------------------- | ------------- | ------------  | ------------  |
| `jetstream-installers:lab404-impersonate`| :x:           | :heavy_check_mark:  | :heavy_check_mark:  |

## Installation

You can install the package via composer:

```bash
composer require headerx/laravel-jetstream-installers
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-jetstream-installers-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-jetstream-installers-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-jetstream-installers-views"
```

## Usage

### Running Commands

Currently the only command available is for `lab404/laravel-impersonate`:
```bash
php artisan jetstream-installers:lab404-impersonate --help
Description:
  install lab404/laravel-impersonate into skeleton with routes and views

Usage:
  jetstream-installers:lab404-impersonate [options]

Options:
      --composer[=COMPOSER]  Absolute path to the Composer binary which should be used to install packages [default: "global"]
  -h, --help                 Display help for the given command. When no command is given display help for the list command
  -q, --quiet                Do not output any message
  -V, --version              Display this application version
      --ansi|--no-ansi       Force (or disable --no-ansi) ANSI output
  -n, --no-interaction       Do not ask any interactive question
      --env[=ENV]            The environment the command should run under
  -v|vv|vvv, --verbose       Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug 
```

### Writing Your Own Installers

```php
Installer::insertLineAfter(
    app_path('Models/User.php'),
    'use Laravel\\Jetstream\\HasProfilePhoto;',
    'use Lab404\\Impersonate\Models\\Impersonate;'
)
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [inmanturbo](https://github.com/headerx)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
