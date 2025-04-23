<?php

namespace App\Livewire;

use App\Models\amount;
use App\Models\investment;
use App\Models\setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class PlanChart extends Component
{
    public $plan;
    public $min;
    public $max;
    public $minContract;
    public $maxContract;
    public $amount;

    public function mount($plan = '', $min = 0, $max = 0, $minContract = 0, $maxContract = 0)
    {
        $this->plan = $plan;
        $this->min = $min;
        $this->max = $max;
        $this->minContract = $minContract;
        $this->maxContract = $maxContract;
    }

    public function convertToRupiah($amount)
    {
        $dataCurrency = Cache::get('data_currency', []);
        $rate = 1 / $dataCurrency['idr'][strtolower(session('currency') ?? "IDR")];

        return $amount * $rate;
    }

    public function getCurrency($amount)
    {
        $dataCurrency = Cache::get('data_currency', []);
        return round($amount * $dataCurrency['idr'][strtolower(session('currency') ?? "IDR")], 4);
    }

    public function invest()
    {

        // Validasi input dengan aturan dinamis
        $this->validate([
            'amount' => 'required|numeric|min:' . $this->min . '|max:' . $this->max,
        ]);

        $userAmount = auth()->user()->userAmount->where('status', 'success')->sum('amount') ?? 0;
        $cekAmount = getCurrency($userAmount) - getCurrency($this->amount);
        if (session('currency') ?? "IDR" != "IDR") {
            $cekAmount = getCurrency($userAmount) - $this->amount;
        }

        if ($cekAmount < 0) {
            $this->addError('alert', 'Your balance is not sufficient to make an investment!');
            return;
        }


        if (getCurrency($this->amount) > PHP_INT_MAX || getCurrency($this->amount) < PHP_INT_MIN) {
            $this->addError('alert', 'Value exceeds the allowed limit!');
            return;
        }

        investment::create([
            'user_id' => Auth::id(),
            'package' => $this->plan,
            'amount' => $this->convertToRupiah($this->amount),
            'status' => 'pending',
            'invoice' => 'INV-' . strtoupper(uniqid()),
        ]);

        amount::create([
            'user_id' => Auth::id(),
            'amount' => $this->convertToRupiah(-$this->amount),
            'type' => 'invest',
            'status' => 'success',
            'noted' => "Investasi ke Plan $this->plan",
            'from_user' => Auth::id(),
        ]);

        redirect()->to(setting::first()->telegram);
        $this->reset('amount');
        session()->flash('message', 'Invest successfully!');
    }

    public function render()
    {
        return view('livewire.plan-chart');
    }
}
