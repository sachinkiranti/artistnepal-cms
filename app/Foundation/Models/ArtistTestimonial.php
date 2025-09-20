<?php

namespace Foundation\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kiranti\Supports\BaseModel as Model;

class ArtistTestimonial extends Model
{

    protected $fillable = [
        'artist_profile_id',
        'content',
        'endorser',
        'endorser_title',
        'status',
        'priority',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function ($testimonial) {
            if (is_null($testimonial->priority)) {
                $testimonial->priority = ArtistTestimonial::where('artist_profile_id', $testimonial->artist_profile_id)
                        ->max('priority') + 1;
            }
        });
    }

    public function artistProfile(): BelongsTo
    {
        return $this->belongsTo(ArtistProfile::class);
    }

}
