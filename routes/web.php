<?php

use App\Jobs\OpenAlexWorksSync;
use App\Models\Work;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    OpenAlexWorksSync::dispatch();
});
