<?php

namespace App\Jobs;

use App\Models\Work;
use App\Services\OpenAlex\OpenAlexService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;

class OpenAlexWorksSync implements ShouldQueue
{
    use Queueable;

    public function __construct( public ?int $page = 1)
    {

    }

    public function handle(): void
    {
        $works = (new OpenAlexService())->getWorks($this->page);

        if (empty($works)) {
            return;
        }
        foreach ($works as $work) {
          OpenAlexWorkSync::dispatch($work['id']);
        }
        OpenAlexWorksSync::dispatch($this->page + 1);
    }

}
