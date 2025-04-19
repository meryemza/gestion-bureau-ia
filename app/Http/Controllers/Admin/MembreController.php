<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class MembreController extends Controller
{
    public function index()
    {
        // Récupérer uniquement les utilisateurs ayant le rôle "employe"
        $employes = User::where('role', 'employe')->get();

        return view('admin.membres.index', compact('employes'));
    }
}

