<?php

namespace Foundation\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kiranti\Supports\BaseModel as Model;

class ArtistMedia extends Model
{

    protected $fillable = [
        'artist_profile_id',
        'title',
        'description',
        'url',
        'media_type',
        'metas',
        'is_public',
        'status',
        'priority',
    ];

    protected $casts = [
        'metas' => 'array',
        'is_public' => 'boolean',
        'status' => 'boolean',
    ];


    public function artistProfile(): BelongsTo
    {
        return $this->belongsTo(ArtistProfile::class);
    }

}
