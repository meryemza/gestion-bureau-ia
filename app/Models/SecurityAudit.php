<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SecurityAudit extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
        'url',
        'project_type',
        'launch_date',
        'developer',
        'scan_status',
        'vulnerabilities',
        'severity_score',
        'scan_results',
        'audit_type',
        'scope',
        'priority',
        'status',
        'code_analysis',
        'compliance_results',
        'report',
        'error_message'
    ];

    protected $casts = [
        'vulnerabilities' => 'array',
        'launch_date' => 'date',
        'severity_score' => 'float',
        'code_analysis' => 'array',
        'compliance_results' => 'array',
        'report' => 'array'
    ];

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'completed' => 'success',
            'in_progress' => 'warning',
            'failed' => 'danger',
            default => 'secondary'
        };
    }

    public function getPriorityBadgeAttribute()
    {
        return match($this->priority) {
            'high' => 'danger',
            'medium' => 'warning',
            'low' => 'info',
            default => 'secondary'
        };
    }

    public function getFormattedReportAttribute()
    {
        if (!$this->report) {
            return null;
        }

        return [
            'summary' => $this->report['executive_summary'] ?? null,
            'findings' => $this->report['detailed_findings'] ?? null,
            'recommendations' => $this->report['recommendations'] ?? null,
            'risks' => $this->report['risk_assessment'] ?? null
        ];
    }
} 