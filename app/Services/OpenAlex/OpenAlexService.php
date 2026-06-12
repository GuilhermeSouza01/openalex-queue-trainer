<?php

namespace App\Services\OpenAlex;

use Illuminate\Support\Facades\Http;

class OpenAlexService
{
    public function getWorks(int $page): array
    {
        $url = 'works?page='.$page;
        $response = (new Client())->http()->get($url);
        return $response->json('results');
    }

    public function getWorkById($id)
    {
        $url = 'works/' . $id;
        $response = (new Client())->http()->get($url);

        return $response->json();
    }
}
