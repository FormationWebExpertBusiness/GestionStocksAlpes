<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $username;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'username' => ['required', 'alpha'],
        'password' => ['required'],
    ];

    protected $messages = [
        'username.required' => 'l\'utilisateur doit être renseigné',
        'username.alpha' => 'l\'utilisateur ne contient que des lettres',
        'password.required' => 'le mot de passe doit être renseigné',
    ];

    public function render()
    {
        return view('livewire.login');
    }

    public function connectUser()
    {
        $credentials = $this->validate();

        if (Auth::attempt($credentials)) {
            return redirect('/stock');
        }
        $this->adderror('password', 'Le mot de passe est incorrect pour cet utilisateur');
        $this->password = '';
    }
}
