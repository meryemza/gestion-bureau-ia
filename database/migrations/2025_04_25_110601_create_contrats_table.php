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
        Schema::create('contrats', function (Blueprint $table) {
            $table->id();
            $table->string('employe');
            $table->enum('type', ['CDI', 'CDD', 'Stage']);
            $table->date('date_debut');
            $table->date('date_fin')->nullable();
            $table->enum('statut', ['Actif', 'En cours', 'Terminé']);
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('contrats');
    }
};
