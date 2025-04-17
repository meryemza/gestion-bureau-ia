<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginForm extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:8',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            // Redirection intelligente vers le bon dashboard selon le rôle
            return redirect('/redirect-role');
        }

        // Si la connexion échoue
        throw ValidationException::withMessages([
            'email' => ['Les informations d\'identification sont incorrectes.'],
        ]);
    }

    public function render()
    {
        return view('livewire.login-form');
    }
}
