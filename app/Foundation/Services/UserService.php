<?php

namespace Foundation\Services;

use Foundation\Lib\Role;
use Foundation\Lib\SoftDelete;
use Foundation\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Kiranti\Config\Status;
use Kiranti\Supports\BaseService;
use PhpParser\Node\Scalar\String_;

/**
 * Class UserService
 * @package Foundation\Services
 */
class UserService extends BaseService
{

    /**
     * The User instance
     *
     * @var $model
     */
    protected $model;

    /**
     * UserService constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Filter
     *
     * @param array $data
     * @return mixed
     */
    public function filter(array $data)
    {
        $model = $this->model;

        switch ($data['filter']['soft_delete']) {
            case SoftDelete::ONLY_TRASHED :
                $model = $model->onlyTrashed();
                break;
            case SoftDelete::WITH_TRASHED :
                $model = $model->withTrashed();
                break;
        }

        return $model
            ->where(function ($query) use ($data){
                if($data['filter']['name']){
                    $query->where('first_name', 'like', '%'. $data['filter']['name'] .'%')
                    ->orWhere('middle_name', 'like', '%'. $data['filter']['name'] .'%')
                    ->orWhere('last_name', 'like', '%'. $data['filter']['name'] .'%');
                }
                if($role = $data['filter']['role']){
                    $query->whereHas('roles', function ($query) use ($role){
                        $query->where('roles.id', $role);
                    });
                }
                if($data['filter']['creation']['start']){
                    $query->whereDate('created_at', '>=', $data['filter']['creation']['start']);
                }
                if($data['filter']['creation']['end']){
                    $query->whereDate('created_at', '<=', $data['filter']['creation']['end']);
                }
            })
            ->latest();
    }

    public function getUsersHavingRole($role, $limit = 0)
    {
        $queries = $this->model
            ->select('*')
            ->selectRaw('CONCAT_WS(" ", first_name, middle_name, last_name) AS full_name')
            ->whereHas('roles', function (Builder $query) use ($role) {
                $query->where('slug', 'like', $role);
            });

        if ($limit) {
            $queries->limit($limit);
        }

        return $queries
            ->where('status', Status::ACTIVE_STATUS)
            ->get();
    }

    public function getArtists(int $paginate = 10, array $filters = [])
    {
        $queries = $this->model
            ->select('*')
            ->selectRaw('CONCAT_WS(" ", first_name, middle_name, last_name) AS full_name')
            ->whereHas('roles', function (Builder $query) {
                $query->where('slug', 'like', \App\Foundation\Enums\Role::ROLE_ARTIST);
            });

//        $queries->when(!empty($filters['category']), function ($query) use ($filters) {
//            $query->where('category_id', $filters['category']);
//        })
        $queries->when(!empty($filters['search']), function ($query) use ($filters) {
                $search = $filters['search'];
                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                        ->orWhere('middle_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhereRaw('CONCAT_WS(" ", first_name, middle_name, last_name) LIKE ?', ["%{$search}%"]);
                });
            });
//        ->when(!empty($filters['eras']), function ($query) use ($filters) {
//            $query->whereIn('era_id', (array) $filters['eras']);
//        })
//        ->when(!empty($filters['artist_status']), function ($query) use ($filters) {
//            $query->where('status', $filters['artist_status']);
//        });

        return $queries->paginate($paginate);
    }

    public function pluckAuthor()
    {
        return $this->getUsersHavingRole(Role::$current[Role::ROLE_AUTHOR])
            ->pluck('full_name', 'id');
    }

    public function getLoggedInUser()
    {
        return request()->user();
    }

    /**
     * @param String|null $type
     * @return int
     */
    public function getCountByUserType(String $type = null)
    {
         return DB::table('users')
            ->join('role_user', 'role_user.user_id','=','users.id')
            ->join('roles', 'roles.id','=','role_user.role_id')
            ->where('roles.slug', $type)
            ->count();
    }

    public function total()
    {
        return app('db')
            ->table('users')
            ->join('role_user', 'role_user.user_id','=','users.id')
            ->join('roles', 'roles.id','=','role_user.role_id')
            ->selectRaw('count(*) as total')
            ->selectRaw("count(case when roles.slug = '0' then 1 end) as happy")
            ->selectRaw("count(case when roles.slug = '1' then 1 end) as sad")
            ->selectRaw("count(case when roles.slug = '2' then 1 end) as excited")
            ->selectRaw("count(case when roles.slug = '3' then 1 end) as sleepy")
            ->selectRaw("count(case when roles.slug = '4' then 1 end) as angry")
            ->selectRaw("count(case when roles.slug = '5' then 1 end) as surprise")
            ->first();
    }

    /**
     * @param $id
     * @return bool
     */
    public function forceDelete($id)
    {
        $user = $this->model->withTrashed()->findOrFail($id);
        $user->forceDelete();
        return true;
    }

    /**
     * @param $id
     * @return bool
     */
    public function restore($id)
    {
        $user = $this->model->onlyTrashed()->findOrFail($id);
        $user->restore();
        return true;
    }

    public function byIdentifier(string $identifier)
    {
        return $this->model
            ->select('*')
            ->selectRaw('CONCAT_WS(" ", first_name, middle_name, last_name) AS full_name')
            ->withCount('posts')
            ->with([
                'posts' => function ($query) {
                    return $query->latest()->limit(10);
                }
            ])
            ->where('unique_identifier', $identifier)->firstOrFail();
    }

}
