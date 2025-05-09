<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecrutementsTable extends Migration
{
    public function up()
    {
        Schema::create('recrutements', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('poste');
            $table->string('email');
            $table->string('cv');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recrutements');
    }
}