<?php

namespace DarioLjubas\OrganizationalRBAC\Traits;

use DarioLjubas\OrganizationalRBAC\Models\Permission;
use DarioLjubas\OrganizationalRBAC\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRoles
{
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            Role::class,
            config('organizational-rbac.table_names')['organization_user_roles'],
            'user_id',
            'role_id'
        )->withTimestamps()
        ->distinct();
    }

    public function hasPermission(string $permission): bool
    {
        foreach ($this->roles as $r) {
            foreach ($r->permissions as $p) {
                if ($p->name == $permission) {
                    return true;
                }
            }
        }

        return false;
    }
}
