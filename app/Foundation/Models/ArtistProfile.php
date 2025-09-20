<?php

namespace Foundation\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kiranti\Supports\BaseModel as Model;

class ArtistProfile extends Model
{

    protected $fillable = [
        'user_id',
        'username',
        'profession_id',
        'banner_image',
        'start_year',
        'country_id',
        'father_name',
        'mother_name',
        'email_address',
        'telephone',
        'mobile',
        'social_links',
        'bio',
        'experiences',
        'awards',
    ];

    protected $casts = [
        'awards' => 'array',
        'social_links' => 'array',
        'verified_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function testimonials(): HasMany
    {
        return $this->hasMany(ArtistTestimonial::class);
    }

    public function medias(): HasMany
    {
        return $this->hasMany(ArtistMedia::class);
    }

}
