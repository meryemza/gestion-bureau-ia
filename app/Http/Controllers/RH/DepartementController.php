<?php

namespace App\Http\Controllers\RH;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('rh.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('rh.departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        Department::create([
            'nom' => $request->nom,
        ]);

        return redirect()->route('rh.departments.index')->with('success', 'Département créé avec succès.');
    }

    public function show(Department $department)
    {
        return view('rh.departments.show', compact('department'));
    }

    public function edit(Department $department)
    {
        return view('rh.departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $department->update([
            'nom' => $request->nom,
        ]);

        return redirect()->route('rh.departments.index')->with('success', 'Département mis à jour avec succès.');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('rh.departments.index')->with('success', 'Département supprimé avec succès.');
    }
}
