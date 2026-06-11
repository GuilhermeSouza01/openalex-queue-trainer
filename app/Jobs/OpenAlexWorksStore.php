<?php

namespace App\Jobs;

use App\Models\Work;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class OpenAlexWorksStore implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public array $work)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Work::create([
            'openalex_id' => $this->work['id'],
            'title' => $this->work['title'],
            'doi' => $this->work['doi'],
            'publication_year' => $this->work['publication_year'],
            'is_open_access' => $this->work['open_access']['is_oa'],
            'cited_by_count' => $this->work['cited_by_count'],
            'type' => $this->work['type'],
            'created_date' => $this->work['created_date'],
            'updated_date' => $this->work['updated_date'],
        ]);
    }
}
