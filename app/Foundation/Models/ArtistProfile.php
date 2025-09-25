<?php

namespace Foundation\Models;

use Foundation\Enums\MediaType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kiranti\Supports\BaseModel as Model;
use Kiranti\Supports\Concerns\HasImage;

class ArtistProfile extends Model
{

    protected $table = 'artist_profile';

    use HasImage;

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

    public function galleries(): HasMany
    {
        return $this->hasMany(ArtistMedia::class)
            ->where('media_type', MediaType::IMAGE->value)
            ->where('is_public', 1)
            ->orderByDesc('created_at');
    }

    public static function setFolderName(): string
    {
        return 'artist/banner';
    }

    public function getBannerImage(): string
    {
        if (file_exists(public_path('storage/images/'.static::getFolderName().'/'. ($this->banner_image ?? 'N/A')))) {
            return asset('storage/images/'.static::getFolderName().'/'.$this->banner_image);
        }
        return asset('images/admin/default.jpg');
    }
}
