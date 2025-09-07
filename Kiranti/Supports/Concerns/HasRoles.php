<?php

namespace Kiranti\Supports\Concerns;

use Foundation\Models\Role;
use Foundation\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Trait HasRoles
 * @package Kiranti\Supports\Concerns
 */
trait HasRoles
{

    /**
     * @return BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @param array $role
     * @return array
     */
    public function assignRole(array $role)
    {
        return $this->roles()->sync($role);
    }

    /**
     * Return true if user has given roles
     *
     * @usage $user->hasRole('super-admin','user')
     * @param mixed ...$roles
     * @return bool
     */
    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param string $permission
     * @return bool
     */
    public function havePermission(string $permission)
    {
        $roles = auth()->user()->load('roles.permissions')->roles;

        foreach($roles as $role)
        {
            if($role->name === User::DEFAULT_ROLE)
            {
                return true;
            }
            return $role->inRole($permission);
        }
    }

    public function hasPermission($permission) {
        // contains('key', 'value');
        return (bool) $this->permissions->where('slug', $permission->slug)->count();
    }

}
