<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{


public function up()
{
    Schema::table('salaires', function (Blueprint $table) {
        $table->decimal('montant', 10, 2)->nullable();
        $table->string('status')->default('Non versé');
    });
}

public function down()
{
    Schema::table('salaires', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}
};