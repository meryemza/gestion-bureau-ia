<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('security_audits', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->string('url');
            $table->enum('scan_status', ['en_attente', 'en_cours', 'termine'])->default('en_attente');
            $table->json('vulnerabilities')->nullable();
            $table->float('severity_score')->nullable();
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('security_audits');
    }
}; 