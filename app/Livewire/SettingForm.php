<?php

namespace App\Livewire;

use App\Models\userData;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SettingForm extends Component
{
    public $username;
    public $refferals;
    public $full_name;
    public $address;
    public $country;
    public $email;
    public $phone;
    public $bitcoin_address;
    public $bank;

    protected $rules = [
        'username' => 'required|string|max:12',
        'full_name' => 'required|string|max:100',
        'address' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'email' => 'required|email|max:100',
        'phone' => 'required|string|max:15',
        'bitcoin_address' => 'nullable|string|max:255',
        'bank' => 'nullable|string|max:255',
    ];

    public function mount()
    {
        $user = Auth::user(); // Mendapatkan data user yang sedang login
        $userData = $user->userData; // Pastikan ada relasi user -> user_data

        $this->username = $userData->username; // Mengambil username dari tabel user
        $this->refferals = $user->refferals_count ?? 0; // Hitung jumlah referal jika ada relasi
        $this->full_name = $user->name;
        $this->address = $userData->address ?? '';
        $this->country = $userData->country ?? '';
        $this->email = $user->email;
        $this->phone = $userData->phone_number ?? '';
        $this->bitcoin_address = $userData->bitcoin_address ?? '';
        $this->bank = $userData->bank_number ?? '';
    }

    public function submit()
    {
        $this->validate();

        $user = Auth::user();

        // Update data di tabel users
        $user->update([
            'name' => $this->full_name,
            'email' => $this->email,
        ]);

        // Update atau create data di tabel user_data
        UserData::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'username' => $this->username,
                'address' => $this->address,
                'country' => $this->country,
                'phone_number' => $this->phone,
                'bitcoin_address' => $this->bitcoin_address,
                'bank_number' => $this->bank,
            ]
        );

        session()->flash('message', 'User data updated successfully!');
    }


    public function render()
    {
        return view('livewire.setting-form');
    }
}
