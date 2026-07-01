<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;

#[Signature('openalex:open-alex-works-sync')]
#[Description('Command description')]
class OpenAlexWorksSync extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        Bus::batch([
            new \App\Jobs\OpenAlexWorksSync(),
        ])
            ->then(function (): void {
                info('All Done!');
            })
            ->name('Sync Works Open Alex API')
            ->allowFailures()
            ->dispatch();
    }
}
