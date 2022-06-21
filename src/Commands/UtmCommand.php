<?php

namespace Astrogoat\Utm\Commands;

use Illuminate\Console\Command;

class UtmCommand extends Command
{
    public $signature = 'utm';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
