<?php

namespace Foundation\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kiranti\Supports\BaseModel as Model;
use Kiranti\Supports\Concerns\HasImage;

class ArtistMedia extends Model
{

    protected $table = 'artist_medias';

    use HasImage;

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

    public static function setFolderName(): string
    {
        return 'artist/medias';
    }

    public function getImage(): string
    {
        if (file_exists(public_path('storage/images/'.static::getFolderName().'/'. ($this->url ?? 'N/A')))) {
            return asset('storage/images/'.static::getFolderName().'/'.$this->url);
        }
        return asset('images/admin/default.jpg');
    }

}
