<?php

namespace App\Jobs;

use App\Models\Work;
use App\Services\OpenAlex\OpenAlexService;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;

class OpenAlexWorksSync implements ShouldQueue
{
    use Queueable;
    use Batchable;

    public function __construct( public ?int $page = 1, public ?int $maxPages = 4)
    {

    }

    public function handle(): void
    {
        $works = (new OpenAlexService())->getWorks($this->page);

        if (empty($works)) {
            return;
        }
        $jobs = [];
        foreach ($works as $work) {
          $jobs[] = new OpenAlexWorkSync(
              basename($work['id']));
        }
        $this->batch()->add($jobs);

        if($this->page < $this->maxPages){
            $this->batch()->add([
                new OpenAlexWorksSync($this->page + 1, $this->maxPages),
            ]);

        }
    }

}
