<?php

namespace App\Jobs;

use App\Models\Topic;
use App\Services\OpenAlex\OpenAlexService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class OpenAlexTopicStore implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public array $data)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        Topic::updateOrCreate(
            ['openalex_id' => $this->data['id']],
            [
                'display_name' => $this->data['display_name'],
                'subfield_id' => $this->data['subfield']['id'] ?? null,
                'subfield_name' => $this->data['subfield']['display_name'] ?? null,
                'field_id' => $this->data['field']['id'] ?? null,
                'field_name' => $this->data['field']['display_name'] ?? null,
                'domain_id' => $this->data['domain']['id'] ?? null,
                'domain_name' => $this->data['domain']['display_name'] ?? null,
            ]);
    }
}
