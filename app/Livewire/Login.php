<?php

namespace App\Livewire;

use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;
    public $showPassword = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required'
    ];

    public function show_password()
    {
        $this->showPassword = !$this->showPassword;
    }

    public function mount()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === 'Admin') {
                return redirect()->route('filament.admin.pages.dashboard');
            } else {
                return redirect()->to("/");
            }
        }
    }

    public function authenticate()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            return redirect()->route('filament.admin.auth.login');
        }

        Notification::make()
            ->title('Login Success')
            ->success()
            ->send();

        $this->addError('email', trans('auth.failed'));
    }

    public function render()
    {
        return view('livewire.login');
    }
}
