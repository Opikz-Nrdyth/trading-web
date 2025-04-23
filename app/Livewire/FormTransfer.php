<?php

namespace App\Livewire;

use App\Models\amount;
use App\Models\setting;
use App\Models\User;
use App\Models\userData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class FormTransfer extends Component
{
    public $username;
    public $amount;
    public $amount_transfer;

    public function mount()
    {
        $this->amount = Auth::user()->userAmount->where("status", "success")->sum("amount");
        $this->amount = getCurrency($this->amount);
    }

    public function getCurrency($amount)
    {
        $dataCurrency = Cache::get('data_currency', []);
        return round($amount * $dataCurrency['idr'][strtolower(session('currency') ?? "IDR")], 4);
    }

    public function convertToRupiah($amount)
    {
        $dataCurrency = Cache::get('data_currency', []);
        $rate = 1 / $dataCurrency['idr'][strtolower(session('currency') ?? "IDR")];

        return $amount * $rate;
    }

    public function submit()
    {
        $this->validate([
            'amount_transfer' => 'required|numeric|min:1',
            'username' => 'required|string',
        ]);

        $userIdTarget = optional(User::with('userData')->whereHas('userData', function ($query) {
            $query->where('username', $this->username);
        })->first())->id;

        if (is_null($userIdTarget)) {
            session()->flash('error', 'User Not Found');
            return;
        }

        if (getCurrency($this->amount) < getCurrency($this->amount_transfer)) {
            session()->flash('error', 'Your balance is insufficient');
            return;
        }

        if (session('currency') ?? "IDR" != 'IDR') {
            if ($this->amount_transfer < getCurrency(setting::first()->min_tf)) {
                session()->flash('error', 'Minimal Transfer is ' . getCurrency(setting::first()->min_wd) . ' Your Tranfer is ' . getCurrency($this->amount_transfer));
                return;
            }
        } else {
            if (getCurrency($this->amount_transfer) < getCurrency(setting::first()->min_tf)) {
                session()->flash('error', 'Minimal Transfer is ' . getCurrency(setting::first()->min_wd) . ' Your Tranfer is ' . getCurrency($this->amount_transfer));
                return;
            }
        }

        amount::create([
            'user_id' => $userIdTarget,
            'amount' => $this->convertToRupiah($this->amount_transfer),
            'type' => 'bonus',
            'status' => 'pending',
            'noted' => "Menerima Saldo dari " . Auth::user()->name,
            'from_user' => Auth::id(),
        ]);

        amount::create([
            'user_id' => Auth::id(),
            'amount' => $this->convertToRupiah(-$this->amount_transfer),
            'type' => 'transfer',
            'status' => 'pending',
            'noted' => "Mengirim Saldo ke " . $this->username,
            'from_user' => Auth::id(),
        ]);

        $this->reset(['username', 'amount_transfer']);

        session()->flash('message', 'Transfer SGD ' . $this->amount_transfer . ' To ' . $this->username . ' Success');
    }

    public function render()
    {
        return view('livewire.form-transfer');
    }
}
