<?php

namespace HeaderX\JetstreamInstallers\Commands;

use HeaderX\JetstreamInstallers\Facades\Installer;
use Illuminate\Console\Command;
use Symfony\Component\Process\PhpExecutableFinder;
use Symfony\Component\Process\Process;

class Lab404ImpersonateInstallerCommand extends Command
{
    public $signature = 'jetstream-installers:lab404-impersonate {--composer=global : Absolute path to the Composer binary which should be used to install packages}';

    public $description = 'My command';

    public function handle(): int
    {
        $this->requireComposerPackages('lab404/laravel-impersonate');

        // Add Trait/Use Lab404\Impersonate\Models\Impersonate; after Spatie\Permission\Traits\HasRoles
        $this->askStep(
            'Add Impersonate Trait to Models/User?',
            function () {
                $this->info(
                    Installer::insertLineAfter(
                        app_path('Models/User.php'),
                        'use Laravel\\Jetstream\\HasProfilePhoto;',
                        'use Lab404\\Impersonate\Models\\Impersonate;'
                    )
                );

                $this->info(
                    Installer::insertLineAfter(
                        app_path('Models/User.php'),
                        'use HasProfilePhoto;',
                        'use Impersonate;'
                    )
                );
            }
        );

        // Publish configuration for Lab404/Impersonate permissions
        $this->askStep(
            'Publish configuration of Lab404\Impersonate\ImpersonateServiceProvider?',
            function () {
                $this->call('vendor:publish', [
                    '--provider' => 'Lab404\Impersonate\ImpersonateServiceProvider'
                ]);
            }
        );

        // Add Routes for Impersonate
        $this->askStep(
            'Add impersonate routes?',
            function () {
                $this->info(
                    Installer::insertLineBefore(
                        base_path("routes/web.php"),
                        "Route::get('/', function () {",
                        "Route::impersonate();\n"
                    )
                );
            }
        );

  
        $this->askStep(
            'Add links to user menu?',
            function () {
                $this->info(
                    Installer::insertLineBefore(
                        resource_path('views/navigation-menu.blade.php'),
                        "@if (Laravel\Jetstream\Jetstream::hasApiFeatures())",
                        "\n@lab404impersonateinstallerlinks\n"
                    )
                );
            }
        );

        return self::SUCCESS;
    }

    public function askStep($question, $yesCallback, $noCallback = null)
    {
        if ($this->confirm($question, 'yes')) {
            $yesCallback();
        } else {
            if ($noCallback === null) {
                $this->info('Step Skipped.');
            } else {
                $noCallback();
            }
        }
    }

    /**
     * Installs the given Composer Packages into the application.
     *
     * @param  mixed  $packages
     * @return void
     */
    protected function requireComposerPackages($packages)
    {
        $composer = $this->option('composer');

        if ($composer !== 'global') {
            $command = [$this->phpBinary(), $composer, 'require'];
        }

        $command = array_merge(
            $command ?? ['composer', 'require'],
            is_array($packages) ? $packages : func_get_args()
        );

        (new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });
    }

    /**
     * Get the path to the appropriate PHP binary.
     *
     * @return string
     */
    protected function phpBinary()
    {
        return (new PhpExecutableFinder())->find(false) ?: 'php';
    }
}
