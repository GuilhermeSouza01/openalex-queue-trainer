<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

abstract class Controller
{
    public function __invoke()
    {
        $result = Http::get('https://api.openalex.org/works?search=machine+learning');
        $result = json_decode($result, true);
        dd($result);
    }
}
