<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('security_audits', function (Blueprint $table) {
            $table->string('audit_type')->default('standard')->after('developer');
            $table->string('scope')->default('full')->after('audit_type');
            $table->string('priority')->default('medium')->after('scope');
            $table->string('status')->default('pending')->after('priority');
            $table->json('code_analysis')->nullable()->after('scan_results');
            $table->json('compliance_results')->nullable()->after('code_analysis');
            $table->json('report')->nullable()->after('compliance_results');
            $table->text('error_message')->nullable()->after('report');
        });
    }

    public function down()
    {
        Schema::table('security_audits', function (Blueprint $table) {
            $table->dropColumn([
                'audit_type',
                'scope',
                'priority',
                'status',
                'code_analysis',
                'compliance_results',
                'report',
                'error_message'
            ]);
        });
    }
}; 