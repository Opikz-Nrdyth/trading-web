<?php

namespace App\Livewire;

use App\Models\amount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class FormTopup extends Component
{
    public $amount;

    public function convertToRupiah($amount)
    {
        $dataCurrency = Cache::get('data_currency', []);
        $rate = 1 / $dataCurrency['idr'][strtolower(session('currency') ?? "IDR")];

        return $amount * $rate;
    }

    public function submit()
    {
        $this->validate([
            'amount' => 'required|numeric|min:1',
        ]);
        amount::create([
            'user_id' => Auth::id(),
            'amount' => $this->convertToRupiah($this->amount),
            'type' => 'deposit',
            'status' => 'pending',
            'noted' => "Deposit Saldo",
            'from_user' => Auth::id(),
        ]);

        session()->flash('message', 'Deposit SGD ' . $this->amount . ' successful, and waiting for confirmation');
    }

    public function render()
    {
        return view('livewire.form-topup');
    }
}
