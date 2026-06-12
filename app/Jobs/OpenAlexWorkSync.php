<?php

namespace App\Jobs;

use App\Models\Work;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;

class OpenAlexWorkSync implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $id)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $url = 'https://api.openalex.org/works/' . $this->id . '/';
        dump($url);
        $workResponse = Http::get($url);

        $work = $workResponse->json();

        Work::create([
            'openalex_id' => $work['id'],
            'title' => $work['title'],
            'doi' => $work['doi'],
            'publication_year' => $work['publication_year'],
            'is_open_access' => $work['open_access']['is_oa'],
            'cited_by_count' => $work['cited_by_count'],
            'type' => $work['type'],
            'created_date' => $work['created_date'],
            'updated_date' => $work['updated_date'],
        ]);
    }
}
