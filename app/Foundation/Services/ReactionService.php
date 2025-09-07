<?php

namespace Foundation\Services;

use Foundation\Models\Post;
use Foundation\Models\Reaction;
use Kiranti\Supports\BaseService;

/**
 * Class ReactionService
 * @package Foundation\Services
 */
final class ReactionService extends BaseService
{

    /**
     * The Comment instance
     *
     * @var $model
     */
    protected $model;

    /**
     * ReactionService constructor.
     *
     * @param Reaction $reaction
     */
    public function __construct(Reaction $reaction)
    {
        $this->model = $reaction;
    }

    public function forPost(Post $post, array $data)
    {
        $post->reactions()->updateOrcreate([
            'signature'     => $data['signature'],
            'reactable_id'  => $data['post-id'],
        ], [ 'type'         => $data['type'], ]);
    }

    public function withReactable()
    {
        return $this->model->with('reactable')->latest()->paginate(20);
    }

    public function summary(Post $post)
    {
        return $post->reactions()
            ->selectRaw('count(id) as total')
            ->selectRaw("count(case when type = '0' then 1 end) as happy")
            ->selectRaw("100.0 * count(case when type = '0' then 1 end) / count(*) as happy_percentage")
            ->selectRaw("count(case when type = '1' then 1 end) as sad")
            ->selectRaw("100.0 * count(case when type = '1' then 1 end) / count(*) as sad_percentage")
            ->selectRaw("count(case when type = '2' then 1 end) as excited")
            ->selectRaw("100.0 * count(case when type = '2' then 1 end) / count(*) as excited_percentage")
            ->selectRaw("count(case when type = '3' then 1 end) as sleepy")
            ->selectRaw("100.0 * count(case when type = '3' then 1 end) / count(*) as sleepy_percentage")
            ->selectRaw("count(case when type = '4' then 1 end) as angry")
            ->selectRaw("100.0 * count(case when type = '4' then 1 end) / count(*) as angry_percentage")
            ->selectRaw("count(case when type = '5' then 1 end) as surprise")
            ->selectRaw("100.0 * count(case when type = '5' then 1 end) / count(*) as surprise_percentage")
            ->first();
    }

    public function bySignature(Post $post, string $signature)
    {
        return $post->reactions()->where('signature', $signature)->value('type');
    }

}
