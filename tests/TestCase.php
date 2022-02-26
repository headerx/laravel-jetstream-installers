<?php

namespace HeaderX\JetstreamInstallers\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use HeaderX\JetstreamInstallers\JetstreamInstallersServiceProvider;

class TestCase extends Orchestra
{

    public $nonExistentFilePath;

    public $filepath;

    public $backupFilePath;
    
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'HeaderX\\JetstreamInstallers\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );

        $this->nonExistentFilePath = __DIR__ . '/checks/nonexistingfile.txt';
        $this->filepath = __DIR__ . '/checks/file.txt';
        $this->backupFilePath = __DIR__ . '/checks/backup.txt';

        file_put_contents($this->filepath, file_get_contents($this->backupFilePath));
    }

    protected function getPackageProviders($app)
    {
        return [
            JetstreamInstallersServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-jetstream-installers_table.php.stub';
        $migration->up();
        */
    }
}
