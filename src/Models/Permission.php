<?php

namespace DarioLjubas\OrganizationalRBAC\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('organizational-rbac.table_names')['permissions'] ?? parent::getTable();
    }
}
