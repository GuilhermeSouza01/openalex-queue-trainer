<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = [
        'openalex_id',
        'title',
        'doi',
        'publication_year',
        'is_open_access',
        'cited_by_count',
        'type',
        'created_date',
        'updated_date',
    ];
}
