<?php

namespace App\Jobs;

use App\Services\OpenAlex\OpenAlexService;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class OpenAlexTopicsSync implements ShouldQueue
{
    use Queueable;
    use Batchable;

    /**
     * Create a new job instance.
     */
        public function __construct(public ?int $page = 1, public ?int $maxPages = 4)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $topics = (new OpenAlexService())->getAllTopics($this->page);

        if (empty($topics)) {
            return;
        }

        $jobs = [];

        foreach ($topics as $topicData) {
            $jobs[] = new OpenAlexTopicStore($topicData);
        }
        if($this->page < $this->maxPages){
            $this->batch()->add([
                new OpenAlexTopicsSync($this->page + 1, $this->maxPages),
            ]);
        }

    }
}
