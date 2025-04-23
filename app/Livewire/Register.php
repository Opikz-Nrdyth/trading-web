<?php

namespace App\Livewire;

use App\Models\notification as ModelsNotification;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $username;
    public $name;
    public $email;
    public $password;
    public $confirm_password;
    public $referals;
    public $showPassword = false;

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

        $this->referals = session('reff');
    }

    protected $rules = [
        'username' => 'required|min:3|max:50|unique:user_data,username',
        'name' => 'required|max:100|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
        'confirm_password' => 'required|same:password',
        'referals' => 'nullable|exists:user_data,username'
    ];


    public function show_password()
    {
        $this->showPassword = !$this->showPassword;
    }

    public function regist()
    {

        $this->validate();

        try {
            $user = User::create([
                'email' => $this->email,
                'name' => $this->name,
                'password_view' => $this->password,
                'password' => Hash::make($this->password),
            ]);

            // Update username di userData yang sudah di-create via boot
            $user->userData()->update([
                'username' => $this->username,
                'referals' => $this->referals
            ]);

            ModelsNotification::create([
                'user_id' => $user->id,
                'type' => 'info',
                'title' => 'Welcome ' . $this->name,
                'message' => 'We’re thrilled to have you on board. Whether you’re a seasoned trader or just starting out, this is your gateway to a world of opportunities. 📈 Enjoy seamless trading with our user-friendly platform, cutting-edge tools, and market insights tailored just for you. Remember, trading is not just about profits—it’s about learning, growing, and staying positive. Feel free to reach out if you need assistance.Happy trading and may your journey be filled with success! 🚀',
            ]);

            Notification::make()
                ->title('Registration successful!')
                ->success()
                ->send();

            // Login user setelah register
            auth()->login($user);

            return redirect()->intended('/admin');
        } catch (\Exception $e) {
            Notification::make()
                ->title('Registration failed!')
                ->danger()
                ->send();

            $this->addError('referals', 'Registration failed. Please try again.' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.register');
    }
}
