<?php

namespace DarioLjubas\OrganizationalRBAC;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('organizational-rbac')
            ->hasConfigFile()
            ->hasMigration('create_rbac_tables');
    }
}
