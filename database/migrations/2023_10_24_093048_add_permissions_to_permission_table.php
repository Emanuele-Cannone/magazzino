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
        DB::unprepared("INSERT INTO permissions (name, guard_name, created_at, updated_at) VALUES
            ('Crea Utente', 'web', now(), now()),
            ('Modifica Utente', 'web', now(), now()),
            ('Elimina Utente', 'web', now(), now()),
            ('Crea Appuntamento', 'web', now(), now()),
            ('Modifica Appuntamento', 'web', now(), now()),
            ('Elimina Appuntamento', 'web', now(), now()),
            ('Crea Ruolo', 'web', now(), now()),
            ('Modifica Ruolo', 'web', now(), now()),
            ('Elimina Ruolo', 'web', now(), now()),
            ('Assegna Permesso - Ruolo', 'web', now(), now()),
            ('Crea Permesso', 'web', now(), now()),
            ('Modifica Permesso', 'web', now(), now()),
            ('Elimina Permesso', 'web', now(), now()),
            ('Crea Cliente', 'web', now(), now()),
            ('Modifica Cliente', 'web', now(), now()),
            ('Elimina Cliente', 'web', now(), now()),
            ('Crea Articolo', 'web', now(), now()),
            ('Modifica Articolo', 'web', now(), now()),
            ('Elimina Articolo', 'web', now(), now()),
            ('Crea Gruppo', 'web', now(), now()),
            ('Modifica Gruppo', 'web', now(), now()),
            ('Elimina Gruppo', 'web', now(), now())
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permission', function (Blueprint $table) {
            //
        });
    }
};
