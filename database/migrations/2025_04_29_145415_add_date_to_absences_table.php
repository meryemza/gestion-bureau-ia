<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('absences', function (Blueprint $table) {
            $table->date('date')->nullable();// Ajouter la colonne 'date'
        });
    }
    
    public function down()
    {
        Schema::table('absences', function (Blueprint $table) {
            $table->dropColumn('date');
        });
    }
    

    /**
     * Reverse the migrations.
     */

};
