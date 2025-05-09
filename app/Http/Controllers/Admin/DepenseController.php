<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Depense;
use Illuminate\Http\Request;

class DepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $depenses = Depense::latest()->paginate(10);
        return view('admin.depenses.index', compact('depenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.depenses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'montant' => 'required|numeric|min:0',
            'date' => 'required|date',
            'categorie' => 'required|string|max:100',
        ]);

        Depense::create($request->all());

        return redirect()->route('admin.depenses.index')
            ->with('success', 'Dépense créée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Depense $depense)
    {
        return view('admin.depenses.show', compact('depense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Depense $depense)
    {
        return view('admin.depenses.edit', compact('depense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Depense $depense)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'montant' => 'required|numeric|min:0',
            'date' => 'required|date',
            'categorie' => 'required|string|max:100',
        ]);

        $depense->update($request->all());

        return redirect()->route('admin.depenses.index')
            ->with('success', 'Dépense mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Depense $depense)
    {
        $depense->delete();

        return redirect()->route('admin.depenses.index')
            ->with('success', 'Dépense supprimée avec succès');
    }
} 