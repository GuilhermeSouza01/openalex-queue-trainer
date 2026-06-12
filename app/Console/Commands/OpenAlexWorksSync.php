<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:open-alex-works-sync')]
#[Description('Command description')]
class OpenAlexWorksSync extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        \App\Jobs\OpenAlexWorksSync::dispatch();
    }
}
