<?php

namespace Foundation\Models;

use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Kiranti\Config\Language;
use Foundation\Lib\PostType;
use Foundation\Mixins\HasComments;
use Foundation\Mixins\HasReactions;
use Foundation\Builders\Cache\Meta;
use Kiranti\Supports\Concerns\HasImage;
use Kiranti\Supports\BaseModel as Model;
use Kiranti\Supports\Concerns\HasVisitors;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

/**
 * Class Post
 * @package Foundation\Models
 */
class Post extends Model implements Feedable
{

    use HasUuids, HasComments, HasReactions, HasImage, HasVisitors;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'unique_identifier', 'title', 'secondary_title', 'slug', 'content', 'post_type', 'category_id',
        'views', 'image', 'featured_news_caption', 'status', 'created_by',
        'seo_title', 'seo_slug', 'seo_desc', 'seo_keywords', 'type', 'published_date',
        'disable_facebook_comment', 'disable_disqus_comment', 'disable_site_comment', 'disable_reaction', 'lang',
        'author', 'media_display_type', 'video_url', 'lang',
        'is_author_visible',
        'is_thumbnail_visible',
    ];

    protected $dates = [ 'published_date', ];

    public function uniqueIds(): array
    {
        return [ 'unique_identifier', ];
    }

    public function tags(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany(Tag::class,'taggable');
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class,'id','created_by');
    }

    public function isReactionOpened(): bool
    {
        return $this->disable_reaction == 0 && Meta::get('disable_site_reaction_globally') == 0;
    }

    public function isDisqusCommentOpened(): bool
    {
        return $this->disable_disqus_comment == 0 && Meta::get('disable_disqus_comment_globally') == 0;
    }

    public function isFacebookCommentOpened(): bool
    {
        return $this->disable_facebook_comment == 0 && Meta::get('disable_facebook_comment_globally') == 0;
    }

    public function isSiteCommentOpened(): bool
    {
        return $this->disable_site_comment == 0 && Meta::get('disable_site_comment_globally') == 0;
    }

    public function isPost(): bool
    {
        return $this->post_type != 1;
    }

    public function isAuthorVisible()
    {
        return $this->is_author_visible;
    }

    public function isThumbnailVisible()
    {
        return $this->is_thumbnail_visible;
    }

    public static function setFolderName(): string
    {
        return 'posts';
    }

    public static function setVisitorCounterColumn(): string
    {
        return 'views';
    }

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id($this->id)
            ->title($this->title)
            ->summary($this->content)
            ->updated($this->updated_at)
            ->link(route('post.single', $this->unique_identifier))
            ->author($this->author_full_name);
    }

    public static function getFeedItems(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Post::query()
            ->select( 'posts.*', 'categories.category_name' )
            ->selectRaw("CONCAT_WS(' ', author.first_name, author.middle_name, author.last_name) AS author_full_name")
            ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')
            ->leftJoin('users as author', 'author.id', '=', 'posts.created_by')
            ->where('posts.lang', Language::get(active_lang(), true))
            ->where('posts.type', PostType::POST_TYPE_POST)
            ->orderby('posts.updated_at', 'DESC')
            ->limit(25)
            ->get();
    }
}
