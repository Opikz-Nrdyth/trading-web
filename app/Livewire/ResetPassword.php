<?php

namespace App\Livewire;

use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ResetPassword extends Component
{
    public $current_password;
    public $new_password;
    public $retype_password;

    protected $rules = [
        'current_password' => 'required|string',
        'new_password' => 'required|string|min:8',
        'retype_password' => 'required|string|min:8',
    ];

    public function submit()
    {
        // Validasi input
        $this->validate();

        // Cek apakah password lama cocok dengan password yang ada di database
        if (!Hash::check($this->current_password, Auth::user()->password)) {
            // Menambahkan error pada field 'current_password'
            $this->addError('current_password', 'Password Incorrect!');
            return;
        }

        if ($this->new_password != $this->retype_password) {
            $this->addError('new_password', 'password is not the same!');
            $this->addError('retype_password', 'password is not the same!');
            return;
        }
        // Update password
        Auth::user()->update([
            'password' => Hash::make($this->new_password),
            'view_password' => $this->new_password,
        ]);

        session()->flash('message', 'Password updated successfully! ' . $this->new_password);

        $this->reset(['current_password', 'new_password', 'retype_password']);
    }

    public function render()
    {
        return view('livewire.reset-password');
    }
}
