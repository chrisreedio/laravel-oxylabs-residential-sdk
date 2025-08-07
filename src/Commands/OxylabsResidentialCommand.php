<?php

namespace ChrisReedIO\OxylabsResidentialSDK\Commands;

use Illuminate\Console\Command;

class OxylabsResidentialCommand extends Command
{
    public $signature = 'laravel-oxylabs-residential-sdk';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
