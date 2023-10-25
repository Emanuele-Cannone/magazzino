<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("
            INSERT INTO roles (name, guard_name, created_at, updated_at) VALUES
            ('Super-Admin', 'web', now(), now()),
            ('Admin', 'web', now(), now()),
            ('Accountant', 'web', now(), now()),
            ('Storekeeper', 'web', now(), now()),
            ('Mechanical', 'web', now(), now()),
            ('Customer', 'web', now(), now()),
            ('Guest', 'web', now(), now())
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
