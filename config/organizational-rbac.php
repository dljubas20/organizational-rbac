<?php

return [
    'table_names' => [
        'users' => 'users',
        'roles' => 'roles',
        'permissions' => 'permissions',
        'organizations' => 'organizations',
        'role_permissions' => 'role_permissions',
        'organization_user_roles' => 'organization_user_roles',
    ],

    'models' => [
        'user' => \App\Models\User::class // default, change if needed
    ],
];
