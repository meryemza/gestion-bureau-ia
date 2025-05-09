<?php 
namespace App\Http\Controllers;

use App\Models\SecurityAudit; // Si tu as un modèle d'audit
use App\Services\AuditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuditeurController extends Controller
{
    protected $auditService;

    public function __construct(AuditService $auditService)
    {
        $this->auditService = $auditService;
    }

    // Méthode pour afficher le tableau de bord
    public function dashboard()
    {
        $stats = [
            'total_audits' => SecurityAudit::count(),
            'completed_audits' => SecurityAudit::where('status', 'completed')->count(),
            'in_progress_audits' => SecurityAudit::where('status', 'in_progress')->count(),
            'pending_audits' => SecurityAudit::where('status', 'pending')->count(),
            'recent_audits' => SecurityAudit::latest()->take(5)->get(),
            'average_score' => SecurityAudit::where('status', 'completed')->avg('severity_score') ?? 0
        ];

        return view('dashboard.auditeur', compact('stats'));
    }

    // Méthode pour afficher les audits
    public function audits()
    {
        $audits = SecurityAudit::latest()->get();
        return view('services.auditeur.audits', compact('audits'));
    }

    // Méthode pour afficher les rapports
    public function rapports()
    {
        $audits = SecurityAudit::where('status', 'completed')->latest()->get();
        return view('services.auditeur.rapports', compact('audits'));
    }

    // Méthode pour afficher la liste des audits de sécurité
    public function securityAudits(Request $request)
    {
        $query = SecurityAudit::query();

        // Filtres
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }
        if ($request->filled('audit_type')) {
            $query->where('audit_type', $request->audit_type);
        }

        $audits = $query->latest()->paginate(10);
        return view('auditeur.security-audits.index', compact('audits'));
    }

    // Méthode pour afficher le formulaire de création d'audit
    public function createAudit()
    {
        return view('auditeur.security-audits.create');
    }

    // Méthode pour enregistrer un nouvel audit
    public function storeAudit(Request $request)
    {
        $validated = $request->validate([
            'project_name' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'project_type' => 'required|string|in:site_statique,web_app,api,autre',
            'launch_date' => 'required|date',
            'developer' => 'required|string|max:255',
            'audit_type' => 'required|string|in:standard,comprehensive,quick',
            'scope' => 'required|string|in:full,partial,custom',
            'priority' => 'required|string|in:high,medium,low'
        ]);

        try {
            DB::beginTransaction();
            
            $audit = $this->auditService->createAudit($validated);
            
            DB::commit();
            
            return redirect()
                ->route('auditeur.security-audits.show', $audit)
                ->with('success', 'Audit créé avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de la création de l\'audit.');
        }
    }

    // Méthode pour afficher les détails d'un audit
    public function showAudit(SecurityAudit $securityAudit)
    {
        return view('auditeur.security-audits.show', compact('securityAudit'));
    }

    public function startAudit(SecurityAudit $securityAudit)
    {
        if ($securityAudit->status !== 'pending') {
            return back()->with('error', 'Cet audit ne peut pas être démarré.');
        }

        try {
            $this->auditService->startAudit($securityAudit);
            return redirect()
                ->route('auditeur.security-audits.show', $securityAudit)
                ->with('success', 'L\'audit a été démarré avec succès.');
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue lors du démarrage de l\'audit.');
        }
    }

    // Méthode pour générer le rapport d'un audit
    public function generateReport(SecurityAudit $securityAudit)
    {
        if ($securityAudit->status !== 'completed') {
            return back()->with('error', 'Le rapport ne peut être généré que pour un audit terminé.');
        }

        try {
            $pdf = $this->auditService->generateReport($securityAudit);
            return $pdf->download('audit-' . $securityAudit->id . '.pdf');
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue lors de la génération du rapport.');
        }
    }
}
