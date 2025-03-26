<?php

namespace DarioLjubas\OrganizationalRBAC\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('organizational-rbac.table_names')['roles'] ?? parent::getTable();
    }
}
