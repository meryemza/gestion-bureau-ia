<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 🔴 Supprimer cette ligne de test une fois que tout fonctionne
        // dd($request->all());
    
        // ✅ Validation des données
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:admin,rh,comptable,employe'],
        ]);
    
        // ✅ Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
    
        event(new Registered($user));
    
        Auth::login($user);
    
        // ✅ Redirection personnalisée par rôle
        return redirect($this->redirectByRole($user->role));
    }
    
    private function redirectByRole($role)
    {
        return match ($role) {
            'admin' => '/admin/dashboard',
            'rh' => '/rh/dashboard',
            'comptable' => '/comptable/dashboard',
            'employe' => '/employe/dashboard',
            default => '/',
        };
    }
    
}
