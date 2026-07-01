<?php

namespace App\Services\OpenAlex;

use Illuminate\Support\Facades\Http;

class OpenAlexService
{
    public function getWorks(int $page): array
    {
        $url = 'works?page='.$page;
        $response = (new Client())->http()->get($url);
        if ($response->status() === 429) {
            throw new \RuntimeException(
                'Open Alex 429:' . $response->body(),
                429
            );
        }
        return $response->json('results');
    }

    public function getWorkById($id)
    {
        $url = 'works/' . $id;
        $response = (new Client())->http()->get($url);

        return $response->json();
    }

    public function getAllTopics(int $page): array
    {
        $url = 'topics?page=' .$page;
        dump($url);
        $response = (new Client())->http()->get($url);
        return $response->json('results');
    }

    public function getTopicById(string $topicId)
    {
        $url = 'topics/' . $topicId;
        $response = (new Client())->http()->get($url);
        return $response->json();
    }
}
