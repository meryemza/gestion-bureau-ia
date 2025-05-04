<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ajouter la colonne `name`.
     */
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // Ajoute une colonne VARCHAR(255) juste après user_id
            $table->string('name')->after('user_id');
        });
    }

    /**
     * La supprimer en rollback.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }
};
