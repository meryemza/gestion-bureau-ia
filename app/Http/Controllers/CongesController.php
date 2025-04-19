<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CongesController extends Controller
{
    public function index()
    {
        return view('conges.rh'); // Assure-toi que 'conges.rh' correspond bien à la vue que tu veux afficher
    }
}
