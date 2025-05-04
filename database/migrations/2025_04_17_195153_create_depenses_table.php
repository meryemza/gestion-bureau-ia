<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepensesTable extends Migration
{
    public function up()
    {
        Schema::create('depenses', function (Blueprint $table) {
            $table->id();
            $table->decimal('montant', 10, 2); // Montant de la dépense
           // $table->date('date'); // Date de la dépense
            $table->string('categorie'); // Catégorie de la dépense (ex: Marketing, Développement)
            $table->timestamps(); // Timestamps pour created_at et updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('depenses');
    }
}
