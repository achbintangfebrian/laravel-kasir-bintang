<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ShowTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:show-tables';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show all tables in the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tables = DB::select('SHOW TABLES');
        $this->info('Database tables:');
        foreach ($tables as $table) {
            $tableName = array_values((array) $table)[0];
            $this->line($tableName);
        }
    }
}