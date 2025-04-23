<?php

namespace App\Http\Controllers\Rh;

use App\Http\Controllers\Controller;
use App\Models\Absence;
use App\Models\User;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    public function index()
    {
        $absences = Absence::with('employe')->latest()->get();
        return view('rh.absences.index', compact('absences'));
    }

    public function create()
    {
        $employes = User::where('role', 'employe')->get();
        return view('rh.absences.create', compact('employes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'motif' => 'required|string|max:255',
        ]);

        Absence::create($request->all());

        return redirect()->route('rh.absences.index')->with('success', 'Absence enregistrée.');
    }

    public function edit(Absence $absence)
    {
        $employes = User::where('role', 'employe')->get();
        return view('rh.absences.edit', compact('absence', 'employes'));
    }

    public function update(Request $request, Absence $absence)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'motif' => 'required|string|max:255',
        ]);

        $absence->update($request->all());

        return redirect()->route('rh.absences.index')->with('success', 'Absence mise à jour.');
    }

    public function destroy(Absence $absence)
    {
        $absence->delete();
        return redirect()->route('rh.absences.index')->with('success', 'Absence supprimée.');
    }
}