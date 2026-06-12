<?php

namespace App\Services\OpenAlex;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class Client
{
    private string $baseUrl = 'https://api.openalex.org/';

    public function http(): PendingRequest
    {
        return Http::baseUrl($this->baseUrl);
    }
}
