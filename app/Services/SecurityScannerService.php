<?php

namespace App\Services;

use App\Models\SecurityAudit;
use Illuminate\Support\Facades\Process;
use Barryvdh\DomPDF\Facade\Pdf;

class SecurityScannerService
{
    public function startScan(SecurityAudit $audit)
    {
        // Mettre à jour le statut
        $audit->update(['scan_status' => 'en_cours']);

        try {
            // Simuler un scan pour le moment
            $this->simulateScan($audit);

            // Mettre à jour le statut final
            $audit->update(['scan_status' => 'termine']);
        } catch (\Exception $e) {
            $audit->update([
                'scan_status' => 'erreur',
                'scan_results' => $e->getMessage()
            ]);
        }
    }

    protected function simulateScan(SecurityAudit $audit)
    {
        // Simuler des résultats de scan
        $vulnerabilities = [
            'owasp_zap' => [
                [
                    'severity' => 'high',
                    'description' => 'Cross-Site Scripting (XSS) vulnerability detected',
                    'location' => '/contact.php',
                    'solution' => 'Implement proper input validation and output encoding'
                ],
                [
                    'severity' => 'medium',
                    'description' => 'SQL Injection vulnerability detected',
                    'location' => '/search.php',
                    'solution' => 'Use prepared statements for database queries'
                ]
            ],
            'nikto' => [
                [
                    'severity' => 'low',
                    'description' => 'Server information disclosure',
                    'location' => '/',
                    'solution' => 'Configure server to hide version information'
                ]
            ],
            'sslyze' => [
                [
                    'severity' => 'medium',
                    'description' => 'Weak cipher suite detected',
                    'location' => 'SSL/TLS',
                    'solution' => 'Disable weak cipher suites and enable only strong ones'
                ]
            ]
        ];

        $audit->update([
            'vulnerabilities' => $vulnerabilities,
            'severity_score' => $this->calculateSeverityScore($vulnerabilities)
        ]);
    }

    protected function calculateSeverityScore($vulnerabilities)
    {
        $score = 0;
        $weights = [
            'high' => 3,
            'medium' => 2,
            'low' => 1
        ];

        foreach ($vulnerabilities as $tool => $issues) {
            foreach ($issues as $issue) {
                $score += $weights[$issue['severity']] ?? 0;
            }
        }

        return min(10, max(0, $score));
    }

    public function generateReport(SecurityAudit $securityAudit)
    {
        $pdf = PDF::loadView('security_audit.report', compact('securityAudit'));
        return $pdf;
    }
} 