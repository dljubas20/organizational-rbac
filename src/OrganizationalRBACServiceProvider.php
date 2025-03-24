<?php

namespace DarioLjubas\OrganizationalRBAC;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use DarioLjubas\OrganizationalRBAC\Commands\OrganizationalRBACCommand;

class OrganizationalRBACServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('organizational-rbac')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_organizational_rbac_table')
            ->hasCommand(OrganizationalRBACCommand::class);
    }
}
