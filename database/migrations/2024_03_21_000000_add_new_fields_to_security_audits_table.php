<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('security_audits', function (Blueprint $table) {
            if (!Schema::hasColumn('security_audits', 'status')) {
                $table->string('status')->default('pending')->after('developer');
            }
            if (!Schema::hasColumn('security_audits', 'audit_type')) {
                $table->string('audit_type')->default('standard')->after('status');
            }
            if (!Schema::hasColumn('security_audits', 'scope')) {
                $table->string('scope')->default('full')->after('audit_type');
            }
            if (!Schema::hasColumn('security_audits', 'priority')) {
                $table->string('priority')->default('medium')->after('scope');
            }
            if (!Schema::hasColumn('security_audits', 'code_analysis')) {
                $table->json('code_analysis')->nullable()->after('scan_results');
            }
            if (!Schema::hasColumn('security_audits', 'compliance_results')) {
                $table->json('compliance_results')->nullable()->after('code_analysis');
            }
            if (!Schema::hasColumn('security_audits', 'report')) {
                $table->json('report')->nullable()->after('compliance_results');
            }
            if (!Schema::hasColumn('security_audits', 'error_message')) {
                $table->text('error_message')->nullable()->after('report');
            }
        });
    }

    public function down()
    {
        Schema::table('security_audits', function (Blueprint $table) {
            $columns = [
                'status',
                'audit_type',
                'scope',
                'priority',
                'code_analysis',
                'compliance_results',
                'report',
                'error_message'
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('security_audits', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
}; 