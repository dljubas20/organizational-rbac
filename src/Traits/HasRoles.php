<?php

namespace DarioLjubas\OrganizationalRBAC\Traits;

use DarioLjubas\OrganizationalRBAC\Models\Organization;
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

    public function rolesInOrganization($org): BelongsToMany
    {
        $orgId = $org instanceof Organization ? $org->id : $org;

        return $this->roles()
            ->wherePivot('organization_id', $orgId);
    }

    public function organizations(): BelongsToMany
    {
        return $this->belongsToMany(
            Organization::class,
            config('organizational-rbac.table_names')['organization_user_roles'],
            'user_id',
            'organization_id'
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

    public function assignRoleInOrganization($org, $role): void
    {
        $roleId = $role instanceof Role ? $role->id : $role;
        $orgId = $org instanceof Organization ? $org->id : $org;

        if (!$this->rolesInOrganization($org)->get()->contains($roleId)) {
            $this->roles()->attach($roleId, [
                'organization_id' => $orgId
            ]);
        }
    }

    public function removeRoleInOrganization($org, $role): void
    {
        $roleId = $role instanceof Role ? $role->id : $role;
        $orgId = $org instanceof Organization ? $org->id : $org;

        if ($this->rolesInOrganization($org)->get()->contains($roleId)) {
            $this->roles()->wherePivot('organization_id', $orgId)->detach($roleId);
        }
    }
}
