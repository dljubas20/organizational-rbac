<?php

namespace DarioLjubas\OrganizationalRBAC\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \DarioLjubas\OrganizationalRBAC\OrganizationalRBAC
 */
class OrganizationalRBAC extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \DarioLjubas\OrganizationalRBAC\OrganizationalRBAC::class;
    }
}
