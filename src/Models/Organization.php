<?php

namespace DarioLjubas\OrganizationalRBAC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Organization extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('organizational-rbac.table_names')['organizations'] ?? parent::getTable();
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            config('organizational-rbac.models')['user'],
            config('organizational-rbac.table_names')['organization_user_roles'],
            'organization_id',
            'user_id'
        )->withTimestamps()
        ->withPivot('role_id')
        ->distinct();
    }
    
    public function usersWithRole($role): BelongsToMany
    {
        $roleId = $role instanceof Role ? $role->id : $role;
        return $this->users()
            ->wherePivot('role_id', $roleId);
    }
}
