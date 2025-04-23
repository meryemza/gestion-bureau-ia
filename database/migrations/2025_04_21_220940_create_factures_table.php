<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->string('titre');
            $table->decimal('montant', 10, 2);
            $table->enum('statut', ['payée', 'en attente', 'relancée'])->default('en attente');
            $table->date('date_echeance')->nullable();
            $table->timestamps();

            // Clé étrangère vers la table clients
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
