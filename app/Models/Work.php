<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function topics(): BelongsToMany
    {
        return $this->belongsToMany(Topic::class, 'topic_work')
            ->withPivot('score');
    }
}
