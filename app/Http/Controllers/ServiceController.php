<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price_ht' => 'required|numeric',
            'price_ttc' => 'required|numeric',
        ]);

        Service::create($request->all());

        return redirect()->route('services.index')->with('success', 'Service ajouté avec succès.');
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|string',
            'price_ht' => 'required|numeric',
            'price_ttc' => 'required|numeric',
        ]);

        $service->update($request->all());

        return redirect()->route('services.index')->with('success', 'Service mis à jour.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service supprimé.');
    }
}
