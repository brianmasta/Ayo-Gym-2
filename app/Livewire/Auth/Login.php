<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;

class Login extends Component
{

    public $email = '';
    public $password = '';
    public $remember_me = false;

    protected $rules = [
        'email' => 'required|email:rfc,dns',
        'password' => 'required|min:6',
    ];

    //This mounts the default credentials for the admin. Remove this section if you want to make it public.
    public function mount()
    {

    }

    public function login()
    {
        $credentials = $this->validate();
    
        if (auth()->attempt(['email' => $this->email, 'password' => $this->password], $this->remember_me)) {
            $user = auth()->user(); // Ambil user yang login
    
            // Redirect berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->intended('/dashboard');
            } elseif ($user->role === 'kasir') {
                return redirect()->intended('/kasir-dashboard');
            } else {
                // Role tidak dikenali
                auth()->logout();
                return $this->addError('email', 'Role pengguna tidak dikenali.');
            }
        } else {
            return $this->addError('email', 'Email atau password salah.');
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
