<?php

namespace App\Jobs;

use App\Models\Topic;
use App\Models\Work;
use App\Services\OpenAlex\OpenAlexService;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;

class OpenAlexWorkSync implements ShouldQueue
{
    use Queueable;
    use Batchable;

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

        $work = (new OpenAlexService())->getWorkById($this->id);

        $workModel = Work::updateOrCreate(
            ['openalex_id' => $work['id']],
            [
                'title'            => $work['title'] ?? 'Sem título',
                'doi'              => $work['doi'] ?? null,
                'publication_year' => $work['publication_year'] ?? null,
                'is_open_access'   => $work['open_access']['is_oa'] ?? false,
                'cited_by_count'   => $work['cited_by_count'] ?? 0,
                'type'             => $work['type'] ?? null,
                'created_date'     => $work['created_date'] ?? null,
                'updated_date'     => $work['updated_date'] ?? null,
            ]
        );
        $topics = [];

        foreach ($work['topics'] ?? [] as $topicData) {
            $topic = Topic::updateOrCreate(
                ['openalex_id' => $topicData['id']],
                [
                    'display_name'  => $topicData['display_name'],
                    'subfield_id'   => $topicData['subfield']['id'] ?? null,
                    'subfield_name' => $topicData['subfield']['display_name'] ?? null,
                    'field_id'      => $topicData['field']['id'] ?? null,
                    'field_name'    => $topicData['field']['display_name'] ?? null,
                    'domain_id'     => $topicData['domain']['id'] ?? null,
                    'domain_name'   => $topicData['domain']['display_name'] ?? null,
                ]
            );
            $topics[$topic->id] = ['score' => $topicData['score'] ?? 0];

        }
        $workModel->topics()->syncWithoutDetaching($topics);
        $this->batch()->add([
            new OpenAlexTopicsSync(),
        ]);
    }
}
