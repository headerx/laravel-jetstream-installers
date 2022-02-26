<?php

namespace HeaderX\JetstreamInstallers\Commands;

use Illuminate\Console\Command;

class JetstreamInstallersCommand extends Command
{
    public $signature = 'laravel-jetstream-installers';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
