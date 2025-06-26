<?php

namespace App\Console\Commands;

use App\Models\Recent;
use Illuminate\Console\Command;

class ClearRecentsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:clear-recents';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear the `recents` database table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Recent::truncate();

        return 0;
    }
}
