<?php

namespace DarioLjubas\OrganizationalRBAC\Commands;

use Illuminate\Console\Command;

class OrganizationalRBACCommand extends Command
{
    public $signature = 'organizational-rbac';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
