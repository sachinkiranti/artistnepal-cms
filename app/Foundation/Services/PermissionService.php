<?php /** @noinspection SqlNoDataSourceInspection */

namespace Foundation\Services;

use Foundation\Models\Permission;
use Kiranti\Config\Status;
use Kiranti\Supports\BaseService;

/**
 * Class PermissionService
 * @package Foundation\Services
 */
class PermissionService extends BaseService
{

    /**
     * The Permission instance
     *
     * @var $model
     */
    protected $model;

    /**
     * PermissionService constructor.
     * @param Permission $permission
     */
    public function __construct(Permission $permission)
    {
        $this->model = $permission;
    }

    /**
     * Filter
     *
     * @param string|null $name
     * @return mixed
     */
    public function filter(string $name = null)
    {
        return $this->model
            ->where(function ($query) use ($name){
                if($name){
                    $query->where('name','like', '%'. $name .'%');
                }
            })
            ->latest();
    }

    /**
     * Get the list of permissions
     *
     * @param null $roleId
     * @return mixed
     */
    public function getPermissionList($roleId = null)
    {
        $query = app('db')
            ->table('permissions')
            ->select('permissions.id as permission_id')
            ->selectRaw("substring_index(substring_index(slug, '_', -1),'_', 1) as 'action' ")
            ->selectRaw("substring_index(substring_index(slug, '_', -2),'_', 1) as 'model' ");
            if($roleId){
                $query->join('permission_role', 'permission_role.permission_id', '=', 'permissions.id')
                        ->where('permission_role.role_id', $roleId);
            }
            return $query->get()->groupBy('model')->toArray();
    }

    /**
     * Get the roles for a permission
     *
     * @param $role
     * @return mixed
     */
    public function getPermissionsForRole($role)
    {
        return $role->load('permissions:permissions.id,name')->permissions->toArray();
    }
}
