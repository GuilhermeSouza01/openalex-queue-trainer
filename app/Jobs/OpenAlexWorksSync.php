<?php

namespace App\Jobs;

use App\Models\Work;
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
        $url = 'https://api.openalex.org/works?page='.$this->page;
        dump($url);
        $worksResponse = Http::get($url);
        $works = $worksResponse->json('results');

        if (empty($works)) {
            return;
        }
        foreach ($works as $work) {
          OpenAlexWorkSync::dispatch($work['id']);
        }
        OpenAlexWorksSync::dispatch($this->page + 1);
    }

}
