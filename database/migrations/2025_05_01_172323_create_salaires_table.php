<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_salaires_table.php

public function up()
{
    Schema::create('salaires', function (Blueprint $table) {
        $table->id();
        $table->foreignId('employe_id')->constrained('users')->onDelete('cascade');
        $table->decimal('salaire_base', 10, 2);
        $table->decimal('prime', 10, 2)->default(0);
        $table->decimal('deduction', 10, 2)->default(0);
        $table->decimal('salaire_net', 10, 2);
        $table->date('date_paiement');
        $table->string('mois'); // Exemple : "Avril 2025"
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaires');
    }
};
