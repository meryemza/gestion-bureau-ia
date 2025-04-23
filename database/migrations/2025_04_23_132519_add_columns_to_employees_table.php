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
        Schema::table('employees', function (Blueprint $table) {
            if (!Schema::hasColumn('employees', 'status')) {
                $table->string('status')->nullable()->after('salary');
            }
    
            if (!Schema::hasColumn('employees', 'gender')) {
                $table->string('gender')->nullable()->after('status');
            }
    
            if (!Schema::hasColumn('employees', 'age')) {
                $table->integer('age')->nullable()->after('gender');
            }
        });
    }
    
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn(['status', 'gender', 'age']);
        });
    }

};
