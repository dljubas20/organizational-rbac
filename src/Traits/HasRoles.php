<?php

namespace DarioLjubas\OrganizationalRBAC;

use DarioLjubas\OrganizationalRBAC\Models\Permission;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRoles
{
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            config('organizational-rbac.models')['roles'],
            config('organizational-rbac.table_names')['organization_user_roles'],
            'user_id',
            'role_id'
        )->withTimestamps()
        ->withPivot('organization_id')
        ->distinct();
    }

    public function hasPermission(string $permission): bool
    {
        foreach ($this->roles() as $r) {
            foreach ($r->permissions as $p) {
                if ($p->name == $permission) {
                    return true;
                }
            }
        }

        return false;
    }
}
