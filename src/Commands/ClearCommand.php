<?php

namespace Alerty\Commands;

use Illuminate\Console\Command;
use Alerty\Models\QueryEntry;

class ClearCommand extends Command
{
    protected $signature = 'alerty:clear';
    protected $description = 'Clean the alerts from database.';

    public function handle()
    {
        $status = $this->confirm("Do you really want to clean the alerts?", true);

        if (! $status){
            $this->warn("It was canceled!");
            return;
        }

        QueryEntry::query()->delete();

        $this->info("The alert table was cleaned, You are fresh now!");
    }
}
