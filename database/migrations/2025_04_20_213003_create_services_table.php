<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('nom'); // Nom du service
            $table->text('description')->nullable(); // Description optionnelle
            $table->decimal('prix_ht', 10, 2); // Prix hors taxes
            $table->decimal('prix_ttc', 10, 2); // Prix toutes taxes comprises
            $table->decimal('suggestion_ia', 10, 2)->nullable(); // Prix proposé par IA (optionnel)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};