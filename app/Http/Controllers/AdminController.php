<?php

// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Tu peux remplacer ces valeurs par des données dynamiques venant de ta base de données
        $stats = [
            'activity_rate' => 20.6,
            'user_count' => 66,
            'sessions' => 11,
            'active_users' => 212,
        ];

        return view('dashboard.admin', compact('stats'));
    }
}
