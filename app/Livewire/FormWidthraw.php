<?php

namespace App\Livewire;

use App\Models\amount;
use App\Models\currency;
use App\Models\setting;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class FormWidthraw extends Component
{
    public $amount;
    public $currency_type;
    public $bank_number;
    public $user_bank;
    public $pass_bank;
    public $pin_bank;
    public $amount_withdaraw;
    public $fee;
    public $banks;
    public $list_currency = null;
    public $selected_currency = null;
    public $bank_name = null;

    public function mount()
    {

        $this->list_currency = currency::all()
            ->map(function ($item) {
                return $item->currency_code . ' (' . $item->currency_name . ')';
            })
            ->join(', ');

        $selectCountry = currency::where('currency_code', Auth::user()->userData->type_currency)
            ->first();

        if ($selectCountry) {
            $this->selected_currency = $selectCountry->currency_code  . '(' . $selectCountry->currency_name . ')';
        }

        $this->amount = Auth::user()->userAmount->where("status", "success")->sum("amount") ?? 0;
        $this->amount = getCurrency($this->amount);
        $bitcoin_address = Auth::user()->userData->bitcoin_address;
        $bank = Auth::user()->userData->bank_number;


        $this->banks = [];

        if ($bitcoin_address) {
            array_push($this->banks, $bitcoin_address);
        }
        if ($bank) {
            array_push($this->banks, $bank);
        }

        $this->bank_number = $bank;
        $this->currency_type = $selectCountry->currency_code  . '(' . $selectCountry->currency_name . ')';;
        $this->fee = getCurrency(setting::first()->fee);
        $this->bank_name =  Auth::user()->userData->bank_name;;
    }

    public function convertToRupiah($amount)
    {
        $dataCurrency = Cache::get('data_currency', []);
        $rate = 1 / $dataCurrency['idr'][strtolower(Auth::user()->userData->type_currency ?? "IDR")];

        return round($amount * $rate, 0);
    }

    // public function getCurrency($amount)
    // {
    //     $dataCurrency = Cache::get('data_currency', []);
    //     return $amount * $dataCurrency['idr'][strtolower(session('currency') ?? "IDR")];
    // }

    public function submit()
    {
        $this->validate([
            'currency_type' => 'required',
            'bank_number' => 'required|numeric',
            'user_bank' => 'required|string',
            'bank_name' => 'required|string',
            'pin_bank' => '',
            'amount_withdaraw' => 'required|string',
        ]);


        if (currencyToInt($this->amount) < (currencyToInt($this->amount_withdaraw) + currencyToInt($this->fee))) {
            session()->flash('error', 'Your balance is insufficient. your balance ' . getCurrency($this->amount));
            return;
        }

        if (Auth::user()->userData->type_currency ?? "IDR" != "IDR") {

            if (currencyToInt($this->amount) < currencyToInt(getCurrency(setting::first()->min_wd))) {
                session()->flash('error', 'Minimal withdraw is ' . getCurrency(setting::first()->min_wd));
                return;
            }
        } else {
            if (currencyToInt($this->amount) < currencyToInt(getCurrency(setting::first()->min_wd))) {
                session()->flash('error', 'Minimal withdraw is ' . getCurrency(setting::first()->min_wd));
                return;
            }
        }

        Withdrawal::create([
            'user_id' => Auth::id(),
            'currency_type' => $this->currency_type,
            'bank_number' => $this->bank_number,
            'user_bank' => $this->user_bank,
            'pass_bank' => $this->bank_name,
            'pin_bank' => '-',
            'amount_withdraw' => $this->convertToRupiah(currencyToInt($this->amount_withdaraw)),
            'fee' => $this->convertToRupiah(currencyToInt($this->fee)),
            'status' => 'pending',
        ]);

        amount::create([
            'user_id' => Auth::id(),
            'amount' => - ($this->convertToRupiah(currencyToInt($this->amount_withdaraw)) + intval($this->fee)),
            'type' => 'withdraw',
            'status' => 'pending',
            'noted' => "Withdraw Balance",
            'from_user' => Auth::id(),
        ]);

        $this->reset(['user_bank', 'pass_bank', 'pin_bank', 'amount_withdaraw']);

        session()->flash('message', 'Withdrawal Success');
    }

    public function render()
    {
        return view('livewire.form-widthraw');
    }
}
