<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop tables from the kasir_pintar database
        DB::statement('DROP TABLE IF EXISTS admin');
        DB::statement('DROP TABLE IF EXISTS rekom_ai');
        DB::statement('DROP TABLE IF EXISTS cache_locks');
        DB::statement('DROP TABLE IF EXISTS failed_jobs');
        DB::statement('DROP TABLE IF EXISTS job_batches');
        DB::statement('DROP TABLE IF EXISTS jobs');
        DB::statement('DROP TABLE IF EXISTS password_reset_tokens');
        DB::statement('DROP TABLE IF EXISTS sessions');
        DB::statement('DROP TABLE IF EXISTS users');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // We won't recreate these tables as they're not needed
    }
};