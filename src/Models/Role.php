<?php

namespace DarioLjubas\OrganizationalRBAC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('organizational-rbac.table_names')['roles'] ?? parent::getTable();
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            Permission::class,
            config('organizational-rbac.table_names')['role_permissions'],
            'role_id',
            'permission_id'
        )->withTimestamps();
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function organizations(): BelongsToMany
    {
        return $this->belongsToMany(
            Organization::class,
            config('organizational-rbac.table_names')['organization_user_roles'],
            'role_id',
            'organization_id'
        )->withTimestamps()
        ->distinct();
    }
}
