<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Topic extends Model
{
    protected $fillable = [
        'openalex_id',
        'display_name',
        'subfield_id',
        'subfield_name',
        'field_id',
        'field_name',
        'domain_id',
        'domain_name',
    ];

    public function works(): BelongsToMany
    {
        return $this->belongsToMany(Work::class, 'topic_work')
            ->withPivot('score');
    }
}
